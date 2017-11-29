#importamos el modulo para trabajar con sockets
import socket
 
#Creamos un objeto socket para el servidor. Podemos dejarlo sin parametros pero si 
#quieren pueden pasarlos de la manera server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s = socket.socket()
 
#Nos conectamos al servidor con el metodo connect. Tiene dos parametros
#El primero es la IP del servidor y el segundo el puerto de conexion
s.connect(("192.168.4.1", 3000))
 
#Instanciamos una entrada de datos para que el cliente pueda enviar mensajes
#Con la instancia del objeto servidor (s) y el metodo send, enviamos el mensaje introducido
mensaje = raw_input("Mensaje a enviar &gt;&gt; ")
s.send(mensaje)
recibido= s.recv(20)
print recibido
#Imprimimos la palabra Adios para cuando se cierre la conexion
print "Adios."
 
#Cerramos la instancia del objeto servidor
s.close()
