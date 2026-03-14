from fastapi import FastAPI
import numpy as np
import joblib

app = FastAPI()


# Example endpoint
@app.get("/predict")
def predict(x: float):
    # Example dummy model
    y = 2 * x + 1
    return {"input": x, "prediction": y}
