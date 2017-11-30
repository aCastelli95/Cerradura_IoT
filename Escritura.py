import random
import time

temp=random.randint(10,30)
hum=random.randint(0,100)
pres=random.randint(4000,5000)

with open('configuracion.txt','a') as file:
		file.write("{0}/{1}/{2}\n".format(temp,hum,pres))