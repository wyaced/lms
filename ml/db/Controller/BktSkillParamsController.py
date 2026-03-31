from db import db
from db.Models.BktSkillParam import BktSkillParam, BktSkillParamSchema
from db.Models.Skill import Skill
import sqlalchemy as sa


engine = db.getEngine()


class BktSkillParamsController:
    @classmethod
    def __getBktParamSkillId(cls, param, session):
        bktParamSkillId = session.scalars(
            sa.select(Skill.id).where(Skill.name == param["skill_name"])
        ).first()

        return bktParamSkillId

    @classmethod
    def __getExistingBktSkillParam(cls, param, session):
        existingBktSkillParam = session.scalars(
            sa.select(BktSkillParam).where(BktSkillParam.skill_id == param["skill_id"])
        ).first()

        return existingBktSkillParam

    @classmethod
    def upsertBktSkillParams(cls, structuredParamsList, session):
        for param in structuredParamsList:
            param["skill_id"] = cls.__getBktParamSkillId(param=param, session=session)

            existing = cls.__getExistingBktSkillParam(param=param, session=session)

            if existing:
                # update
                existing.learn = param["learn"]
                existing.forget = param["forget"]
                existing.guess = param["guess"]
                existing.slip = param["slip"]
                existing.prior = param["prior"]
            else:
                # insert
                newParam = BktSkillParam(**param)
                session.add(newParam)

        session.commit()

    @classmethod
    def getBktSkillParams(cls, session):
        bktSkillParams = session.scalars(sa.select(BktSkillParam)).all()

        return [BktSkillParamSchema.from_orm(param) for param in bktSkillParams]

    @classmethod
    def getBktSkillParam(cls, skillId, session):
        bktSkillParam = session.scalars(
            sa.select(BktSkillParam).where(BktSkillParam.skill_id == skillId)
        ).first()

        return bktSkillParam
