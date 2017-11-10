 
#importamos el modulo para trabajar con sockets

#Creamos un objeto socket para el servidor. Podemos dejarlo sin parametros pero si 
#quieren pueden pasarlos de la manera server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)


#Nos conectamos al servidor con el metodo connect. Tiene dos parametrcaptuos
#El primero es la IP del servidor y el segundo el puerto de conexion

import socket
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.connect(("192.168.4.1", 3000))
mensaje = "nada";
#Creamos un bucle para retener la conexion
while mensaje != "close":    
    mensaje = raw_input("Mensaje a enviar &gt;&gt; ")
    s.send(mensaje) 
    print s.recv(10)
s.close()
