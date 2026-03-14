FROM python:3.11-slim

# Minimal deps for pip
RUN apt-get update && apt-get install -y --no-install-recommends \
    curl git libffi-dev libssl-dev \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY requirements.txt .

RUN pip install --no-cache-dir --upgrade pip setuptools wheel \
    && pip install --no-cache-dir --prefer-binary -r requirements.txt

# Expose a port if you will serve ML API (optional)
EXPOSE 8001

# Default command: drop into Python shell (you can override)
CMD sh -c "uvicorn ml_api:app --host 0.0.0.0 --port 8001"