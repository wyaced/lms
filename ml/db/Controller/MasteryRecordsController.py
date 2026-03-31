from db import db
from db.Controller.BktSkillParamsController import BktSkillParamsController
from db.Models.BktSkillParam import BktSkillParam
from db.Models.MasteryRecord import MasteryRecord, MasteryRecordSchema
from db.Models.QuestionResponse import QuestionResponse
from typing import Sequence
import models.bkt.bkt as bkt
import sqlalchemy as sa


engine = db.getEngine()


class MasteryRecordsController:
    @classmethod
    def __getExistingMasteryRecord(cls, skillId, userId, session):
        existingMasteryRecord = session.scalars(
            sa.select(MasteryRecord)
            .where(MasteryRecord.skill_id == skillId)
            .where(MasteryRecord.user_id == userId)
        ).first()

        return existingMasteryRecord

    @classmethod
    def upsertMasteryRecords(cls, masteryRecords, session):
        for record in masteryRecords:
            existing = cls.__getExistingMasteryRecord(
                skillId=record["skill_id"],
                userId=record["user_id"],
                session=session,
            )

            if existing:
                existing.skill_name = record["skill_name"]
                existing.mastery = record["mastery"]
                existing.updated_at = sa.func.now()

            else:
                record["created_at"] = sa.func.now()
                record["updated_at"] = sa.func.now()

                newRecord = MasteryRecord(**record)
                session.add(newRecord)

        session.commit()

    @classmethod
    def getMasteryRecords(cls, session):
        masteryRecords = session.scalars(sa.select(MasteryRecord)).all()

        return [MasteryRecordSchema.from_orm(record) for record in masteryRecords]

    @classmethod
    def updateMasteryRecord(
        cls, questionResponse: QuestionResponse, bktSkillParams: BktSkillParam, session
    ):
        skillId = questionResponse.skill_id
        userId = questionResponse.user_id
        isCorrect = questionResponse.correct

        masteryRecord = cls.__getExistingMasteryRecord(
            skillId=skillId, userId=userId, session=session
        )

        prevMastery = masteryRecord.mastery
        newMastery = bkt.getNewMastery(
            prevMastery=prevMastery,
            isCorrect=isCorrect,
            bktSkillParams=bktSkillParams,
        )

        masteryRecord.mastery = newMastery
        questionResponse.mastery_is_recorded = True

        session.commit()

    @classmethod
    def updateMasteryRecords(
        cls, unrecordedQuestionResponses: Sequence[QuestionResponse], session
    ):
        for questionResponse in unrecordedQuestionResponses:
            bktSkillParams = BktSkillParamsController.getBktSkillParam(
                skillId=questionResponse.skill_id, session=session
            )
            cls.updateMasteryRecord(
                questionResponse=questionResponse,
                bktSkillParams=bktSkillParams,
                session=session,
            )
