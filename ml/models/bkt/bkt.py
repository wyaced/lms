from db.Models.BktSkillParam import BktSkillParam
from pandas import DataFrame
from pyBKT.models import Model
from typing import Sequence

model = Model(seed=42, num_fits=5)


def getStructuredParamsList(df: DataFrame, skillParams: DataFrame):
    paramsList = skillParams["value"].tolist()
    skills = df["skill_name"].unique()

    structuredParamsList = []
    for i, skill in enumerate(skills):
        base = i * 5
        structuredParamsList.append(
            {
                "skill_name": skill,
                "learn": paramsList[base],
                "forget": paramsList[base + 1],
                "guess": paramsList[base + 2],
                "slip": paramsList[base + 3],
                "prior": paramsList[base + 4],
            }
        )

    return structuredParamsList


def trainModel(df):
    model.fit(data=df)

    bktSkillParams = model.params()

    return bktSkillParams


def initializeMastery(userId: int, skillParams: Sequence[BktSkillParam]):
    masteryRecords = []

    for skillParam in skillParams:
        masteryRecords.append(
            {
                "user_id": userId,
                "skill_id": skillParam.skill_id,
                "skill_name": skillParam.skill_name,
                "mastery": skillParam.prior,
            }
        )

    return masteryRecords


def getNewMastery(prevMastery: float, isCorrect: bool, bktSkillParams: BktSkillParam):
    learn = bktSkillParams.learn
    guess = bktSkillParams.guess
    slip = bktSkillParams.slip

    if isCorrect:
        numerator = prevMastery * (1 - slip)
        denominator = numerator + ((1 - prevMastery) * guess)
    else:
        numerator = prevMastery * slip
        denominator = numerator + ((1 - prevMastery) * (1 - guess))

    if denominator == 0:
        posteriorKnowledge = prevMastery
    else:
        posteriorKnowledge = numerator / denominator

    newMastery = posteriorKnowledge + ((1 - posteriorKnowledge) * learn)

    return newMastery
