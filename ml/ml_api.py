from db import db
from db.Controller.BktSkillParamsController import BktSkillParamsController
from db.Controller.MasteryRecordsController import MasteryRecordsController
from db.Controller.UserController import UserController
from db.Controller.QuestionResponseController import QuestionResponseController
from fastapi import FastAPI
from models.bkt import bkt
import sqlalchemy.orm as orm


app = FastAPI()
engine = db.getEngine()


def serialize(obj):
    data = obj.__dict__.copy()
    data.pop("_sa_instance_state", None)
    return data


# Endpoints ===
# Example endpoint
@app.get("/predict")
def predict(x: float):
    # Example dummy model
    y = 2 * x + 1
    return {"input": x, "prediction": y}


@app.get("/get-students")
def getStudents():
    with orm.Session(engine) as session:
        students = UserController.getStudents(session=session)

    return students


@app.get("/train-bkt")
def trainBkt():
    with orm.Session(engine) as session:
        df = QuestionResponseController.getQuestionResponsesDf()

        bktSkillParamsDf = bkt.trainModel(df)

        print(bktSkillParamsDf)

        structuredParamsList = bkt.getStructuredParamsList(
            df=df, skillParams=bktSkillParamsDf
        )

        BktSkillParamsController.upsertBktSkillParams(
            structuredParamsList=structuredParamsList, session=session
        )

        bktSkillParams = BktSkillParamsController.getBktSkillParams(session=session)

    return bktSkillParams


@app.get("/mastery-init")
def masteryInit(userId: int):
    with orm.Session(engine) as session:
        skillParams = BktSkillParamsController.getBktSkillParams(session=session)

        initialMasteryRecords = bkt.initializeMastery(
            userId=userId, skillParams=skillParams
        )
        MasteryRecordsController.upsertMasteryRecords(
            masteryRecords=initialMasteryRecords, session=session
        )

        masteryRecords = MasteryRecordsController.getMasteryRecords(session=session)

    return masteryRecords


@app.get("/update-mastery-record")
def updateMasteryRecord(questionResponseId: int):
    with orm.Session(engine) as session:
        questionResponse = QuestionResponseController.getQuestionResponse(questionResponseId=questionResponseId, session=session)
        bktSkillParams = BktSkillParamsController.getBktSkillParam(skillId=questionResponse.skill_id, session=session)

        MasteryRecordsController.updateMasteryRecord(questionResponse=questionResponse, bktSkillParams=bktSkillParams, session=session)

        masteryRecords = MasteryRecordsController.getMasteryRecords(session=session)

    return masteryRecords

@app.get("/update-mastery-records")
def updateMasteryRecords():
    with orm.Session(engine) as session:
        unrecordedQuestionResponses = QuestionResponseController.getUnrecordedQuestionResponses(session=session)

        for questionResponse in unrecordedQuestionResponses:
            bktSkillParams = BktSkillParamsController.getBktSkillParam(skillId=questionResponse.skill_id, session=session)
            MasteryRecordsController.updateMasteryRecord(questionResponse=questionResponse, bktSkillParams=bktSkillParams, session=session)

        masteryRecords = MasteryRecordsController.getMasteryRecords(session=session)

    return masteryRecords

# ===
