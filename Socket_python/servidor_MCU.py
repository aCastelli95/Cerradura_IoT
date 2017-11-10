import socket
 
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.connect(("192.168.4.1", 3000)) 
 
s.listen(5)
sc, addr = s.accept() 

while True:
 
    recibido = sc.recv(1024)
 
    if recibido == "cerrar":
        break
 
    print str(addr[0]) + " dice: ", recibido
 
sc.close()
s.close()
