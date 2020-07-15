import numpy as np
from flask import Flask, request, jsonify, render_template
import pickle
import pandas as pd
app = Flask(__name__)
model = pickle.load(open('model.pkl', 'rb'))
#model1 = pickle.load(open('NonIrrigated.pkl', 'rb'))
@app.route('/WindProject',methods=['POST'])
def predict():
    #print("Iriigated")
    #month={"January":1,"February":2,"March":3,"April":4,"May":5,"June":6,"July":7,"August":8,"September":9,"October":10,"November":11,"December":12}
    #soil={"Alluvial":3,"Red":2,"Black":1,"Mountain":6,"Laterite":5,"Desert":4}
    #crop = {1:"Rice",2: "Wheat",3: "Cotton",4:"Sugarcane",5: "Tea",6: "Ragi",7: "Maize",8: "Millet",9: "Barley",10:"Jawar",11:"PigeonPea",12:"ChickPea",13: "Tomato",14:"Brinjal",15:"Chilli",16: "Onion",17:"Garlic",18:"Okra",19: "Safflower",20:"Sunflower",21:"Potato"}
    data = request.get_json()
    print(data)
    #Soil=soil[data['Soil']]
    #Month=month[data['Month']]
    input=[]
    #input.append(Soil)
    #input.append(Month)
    #input.append(data['date'])
    input.append(float(data['theoreticalpower']))
    input.append(float(data['windspeed']))
    input.append(float(data['winddirection']))
    #input.append(float(data['MinpH']))
    #input.append(float(data['MaxpH']))
    print(input)
    input=np.array(input)
    input = np.reshape(input, (input.shape[0], 1, input.shape[1]))
    prediction = model.predict([input])
    print(prediction)
    #output=crop[int(prediction[0])]
    #print(output)
    return jsonify(prediction)
if __name__ == "__main__":
    app.run(debug=True)
