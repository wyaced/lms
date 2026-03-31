from db import db
from db.Models.QuestionResponse import QuestionResponse
import pandas as pd
import sqlalchemy as sa
import sqlalchemy.orm as orm


engine = db.getEngine()


class QuestionResponseController:
    @classmethod
    def getQuestionResponsesDf(cls):
        selectQuestionResponse = sa.select(
            QuestionResponse.user_id,
            QuestionResponse.skill_name,
            QuestionResponse.correct,
            QuestionResponse.order_id,
        )

        with engine.connect() as connection:
            df = pd.read_sql(selectQuestionResponse, connection)
        return df

    @classmethod
    def getQuestionResponses(cls):
        questionResponses = session.scalars(sa.select(QuestionResponse)).all()

        return questionResponses

    @classmethod
    def getUnrecordedQuestionResponses(cls, session):
        unrecordedQuestionResponses = session.scalars(
            sa.select(QuestionResponse).where(QuestionResponse.mastery_is_recorded == 0)
        ).all()

        return unrecordedQuestionResponses

    @classmethod
    def getQuestionResponse(cls, questionResponseId, session):
        questionResponse = session.scalars(
            sa.select(QuestionResponse).where(
                QuestionResponse.id == questionResponseId
            )
        ).first()

        return questionResponse
