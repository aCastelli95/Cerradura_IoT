

import psycopg2
import pprint
import sys
import threading
import socket
#from time import sleep

from flask import Flask
from flask import render_template
from flask import request

app = Flask(__name__)
# app.route define la ruta donde se debe acceder
@app.route('/')

def index():
 
    return render_template('inicio.html');


if __name__ == '__main__':
    """
    Los siguientes comentarios son del trabajo anterior, pero tienen la estructura para crear una base de
    datos en postgres EN PARTES, no de una porque no se que pasa con los punteros de asignacion a la tabla.
    
    """
    #Creamos la tabla de la base de datos
    #baseDeDatos.creacionTabla()
    #baseDeDatos.insertarDatos([(0,),(0,),(0,),(0,),(0,),(0,),(0,),(0,),(0,),(0,)])
    #Cargamos dicha tabla con valores en 0
    #estMete = threading.Thread(target=E_mete.termometro)
    #info = threading.Thread(target)
    #connect()
    #estMete.start()
    #estMete.join()
    #print("Se termino el hilo")
    app.run(host='localhost', port=83)
    #E_mete.termometro()
