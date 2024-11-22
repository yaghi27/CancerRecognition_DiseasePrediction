import subprocess
import uvicorn
from app import app

if __name__ == '__main__':
    try:
        subprocess.run([
            "uvicorn",
            "app:app", 
            "--host", "0.0.0.0",
            "--port", "8700",
            "--reload"
        ])
    except:
        uvicorn.run(app, host="0.0.0.0", port=8700)