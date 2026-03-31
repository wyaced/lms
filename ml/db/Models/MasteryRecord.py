from datetime import datetime
from db import db
from pydantic import BaseModel, ConfigDict
import sqlalchemy as sa
import sqlalchemy.orm as orm


engine = db.getEngine()


# Base Model
class Base(orm.DeclarativeBase):
    pass


# User Model
class MasteryRecord(Base):
    __table__ = sa.Table("mastery_records", Base.metadata, autoload_with=engine)

# Pydantic model for MasteryRecord
class MasteryRecordSchema(BaseModel):
    user_id: int
    skill_id: int
    skill_name: str
    mastery: float
    created_at: datetime
    updated_at: datetime

    model_config = ConfigDict(from_attributes=True)
