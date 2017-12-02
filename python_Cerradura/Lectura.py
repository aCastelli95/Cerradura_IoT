from flask import Flask, render_template, request
import time
import linecache

app = Flask(__name__)

@app.route('/', methods=['GET','POST'])
# Para considerar, la lectura de archivos esta guardando en varaibles
# como si fuera arreglos (pasando como paarmetros en "collection")
#hay que acceder a todo eso con el siguiente ejemplo (castea a un int)
def calcular_promedio(collection):
	total = 0
	col=collection[-10:]
	for item in col:
		total = total + int(item)
	prom=total/len(col)
	return prom


def index():
    
    return render_template('index.html')


if __name__ == '__main__':
    octoacoplador = []
    sensor_m = []
    fin_carera = []
    with open('configuracion.txt','r') as file:
       totalLineas=file.readlines()
       lineas=totalLineas[-10:] #te empiza el recorridod desde el ultimo del archivo, y muestra 10
       for item in lineas:
            datos=item.split("/") #Separo todo por /
            octoacoplador.append(datos[0])
            sensor_m.append(datos[1])
            fin_carera.append(datos[2])
            print(octoacoplador)
            lineas=file.readline()
        
    app.run(debug=True, host='0.0.0.0', port=5000)