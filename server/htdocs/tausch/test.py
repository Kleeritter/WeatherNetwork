import numpy as np
import math 

temp= np.arange(253.15, 313.15 ,1)
ras = 8.314462618
kappa =1.402
menge =0.02896
schall= np.array([])
for i in np.arange(253.15, 313.15 ,1):
    sc= math.sqrt(kappa*((ras*i)/menge))
    schall=np.append(schall, sc)

v = np.arange(0.1, 15.0 ,0.1)
fehlerv= 0.05
d= 0.15
g=77
fehlerd= 0.001
fehlerc= 0.1
fehlert= np.array([])
for i in schall:
    for j in  v:
        fehlerv=0
        while fehlerv < 0.05:
            fehlerte = math.sqrt((((d)/(i+j)**2)*fehlerc)**2+(((d)/(i+j)**2)*fehlerv)**2+(((1)/(i+j)**2)*fehlerd)**2)
            fehlert= np.append(fehlert,fehlerte)
            fehlerv += 0.01

print(max(fehlert))