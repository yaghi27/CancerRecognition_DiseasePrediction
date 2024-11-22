import numpy as np
from utils import get_mean_std_per_batch, load_image
from utils2 import load_and_preprocess_image
from keras.models import load_model
import io
from PIL import Image
from fastapi import FastAPI, File, UploadFile
from typing import List
from keras.preprocessing import image
import os



#------ Model Loading ------#

# Get the current working directory
cwd = os.getcwd()

# Define the relative paths to the models
tuberculosis_model_path = os.path.join(cwd, 'models', 'Tuberculosis_model.h5')
bone_fracture_model_path = os.path.join(cwd, 'models', 'cnn_bone_fracture_model.h5')
breast_cancer_model_path = os.path.join(cwd, 'models', 'BreastCancer_model.h5')
print(tuberculosis_model_path)
print(bone_fracture_model_path)
print(breast_cancer_model_path)

# Load the models
tuberculosis_model = load_model(tuberculosis_model_path, compile=False)
bone_fracture_model = load_model(bone_fracture_model_path, compile=False)
breast_cancer_model = load_model(breast_cancer_model_path)

#------ END - Model Loading ------#

app = FastAPI()
@app.post("/tuberculosis_inference/")
async def run_tuberculosis_inference(image: UploadFile):
    try:
        img_bytes = await image.read()
        processed_image = load_image(img_bytes)
        print(type(processed_image))
        prediction = np.where(tuberculosis_model.predict(processed_image) > 0.5, 1, 0)[0][0]
        print(prediction)
        if int(prediction) == 1:
            result = "POSITIVE"
        else:   
            result = "NEGATIVE"
        return {result}
    except Exception as e:
        return {str(e)}

@app.post("/fracture_inference/")
async def run_fracture_inference(image: UploadFile):
    try:
        img_bytes = await image.read()
        processed_image = load_image(img_bytes, H=224, W=224)
        print(type(processed_image))
        # Reminder: Fracture model is trained on inverted labels
        prediction = np.where(bone_fracture_model.predict(processed_image) < 0.5, 1, 0)[0][0]
        print(prediction)
        if int(prediction) == 1:
            result = "POSITIVE"
        else:   
            result = "NEGATIVE"
        return {result}
    except Exception as e:
        return {str(e)}
    
@app.post("/breastIm_inference/")
async def run_breastIm_inference(image: UploadFile):
    try:
        img_bytes = await image.read()
        processed_image = load_image(img_bytes, H=150, W=150)
        print(type(processed_image))
        # Reminder: Breast Cancer model is trained on inverted labels
        prediction = np.where(breast_cancer_model.predict(processed_image) < 0.5, 1, 0)[0][0]
        print(prediction)
        if int(prediction) == 1:
            result = "POSITIVE"
        else:   
            result = "NEGATIVE"
        return {result}
    except Exception as e:
        return {str(e)}


# img_path = "C:\\Users\\eligr\\fyp\\tuberimgs\\Normal-1029.png"
# img = load_image(img_path)

# img = img.reshape(1, 320, 320, 3)  # Assuming input shape is (320, 320, 3)

# preds = tuberculosis_model.predict(img)
# preds_ = np.where(preds > 0.5,1,0)
# print(preds_[0][0])


# img_path = 'C:\\Users\\eligr\\fyp\\fractureimgs\\not-fractured.png'
# test_image = load_and_preprocess_image(img_path)

# preds = bone_fracture_model.predict(test_image)
# preds_ = np.where(preds > 0.5,1,0)
# print(preds_[0][0])
