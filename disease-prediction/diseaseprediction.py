from sklearn.tree import DecisionTreeClassifier
from sklearn.model_selection import train_test_split
import csv,numpy as np,pandas as pd
import os

data = pd.read_csv(os.path.join("templates", "Training.csv"))
df = pd.DataFrame(data)
cols = df.columns
cols = cols[:-1]
x = df[cols]
y = df['prognosis']
x_train, x_test, y_train, y_test = train_test_split(x, y, test_size=0.33, random_state=42)

print ("DecisionTree")

dt = DecisionTreeClassifier()
clf_dt=dt.fit(x_train,y_train)

indices = [i for i in range(132)]
symptoms = df.columns.values[:-1]

dictionary = dict(zip(symptoms,indices))

symptom_description_df = pd.read_csv("symptom_Description.csv")
symptom_precaution_df = pd.read_csv("symptom_precaution.csv")
symptom_severity_df = pd.read_csv("Symptom-severity.csv")
drbysymtpom_df = pd.read_csv("drbysymptom.csv")

# Create dictionaries for symptom descriptions and precautions
symptom_description_dict = {}
symptom_precaution_dict = {}
symptom_severity_dict = {}
drbysymtpom_dict = {}

# Populate the dictionaries
for index, row in symptom_description_df.iterrows():
    symptom_description_dict[row['Disease']] = row['Description']

for index, row in symptom_precaution_df.iterrows():
    disease = row['Disease']
    precautions = [row['Precaution_1'], row['Precaution_2'], row['Precaution_3'], row['Precaution_4']]
    symptom_precaution_dict[disease] = precautions

for index, row in symptom_severity_df.iterrows():
    symptom_severity_dict[row['Symptom']] = row['weight']

for index, row in drbysymtpom_df.iterrows():
    drbysymtpom_dict[row['Symptom']] = row['Doctor']


def check_descrtion(name):
    if name in symptom_description_dict:
        return "Description: " + symptom_description_dict[name]
    else:
        return "Not found (Description)"

def check_precaution(name):
      if name in symptom_precaution_dict:
        return "Precaution: " + str(symptom_precaution_dict[name])
      
def check_dr(name):
      for i in drbysymtpom_dict:
        if name == i :
            value = drbysymtpom_dict.get(name)
            print(value)
            return symptom_precaution_dict[name]

def clean_string(input_string):

    cleaned_string = input_string.replace('[', '').replace(']', '')
    
    cleaned_string = cleaned_string.replace("'", "")    
    return cleaned_string     

def dosomething(symptom):
    user_input_symptoms = symptom
    if len(symptom) >= 1:
        # You should define 'dictionary' and 'dt.predict' appropriately in your code
        user_input_label = [0 for i in range(132)]
        for i in user_input_symptoms:
            idx = dictionary[i]
            user_input_label[idx] = 1

        user_input_label = np.array(user_input_label)
        user_input_label = user_input_label.reshape((-1, 1)).transpose()
        data = dt.predict(user_input_label)
        data_decision = data[0]


        data_description = check_descrtion(data_decision)
        data_precaution = check_precaution(data_decision)
        data_precaution = clean_string(data_precaution)
        dr = check_dr(data_decision)
    
        print(f"Symptom: {symptom}")
        print(f"Decision: {data_decision}")
        print(f"Description: {data_description}")
        print(f"Precaution: {data_precaution}")
        return data_decision,data_description,data_precaution,dr

print(dosomething(['headache','muscle_weakness','puffy_face_and_eyes','mild_fever','skin_rash']))
