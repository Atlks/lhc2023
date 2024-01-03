



import time
import os
import sys
# pip install pyscreeze
# pip install pyautogui
# pip install PIL
# C:\lhc2023\Python312\Scripts\pip  install PIL
# C:\lhc2023\Python312\python libbot/locateOnScreenTest.py
# C:\lhc2023\Python312\Scripts\pip install opencv-python

# --------------- invk in js------
sys.path.append('D:\\python_module')
sys.path.append('C:\\Users\\attil\\AppData\\Local\\Programs\\Python\\Python312\\Lib\\site-packages')

import os
dir123=os.path.dirname(os.path.realpath(__file__))
sys.path.append(dir123+'/../venv\\Lib\\site-packages')
#sys.path.append('c:\users\u\appdata\local\programs\python\pytho
#n312\lib\site-packages')
print("realpath file:"+os.path.realpath(__file__))
print("dir123:"+dir123)   
#dir123:C:\lhc2023
 

sys.stdin.reconfigure(encoding='utf-8')
sys.stdout.reconfigure(encoding='utf-8')


import pyautogui
import pyscreeze
from PIL import ImageGrab


#print(sys.path)
#quit()

#print(os.getcwd())
# vscode_location = pyautogui.locateOnScreen("C:/0prj/lhc2023/startPic.jpg", region=(0, 0, 999, 999))
import urllib.parse as urlparse
import urllib.parse
 



# urldecode
#url=urllib.parse.unquote(arg338)

 

#quit()
confidence= 0.7

 
img=dir123+"/../cfgBot/start.jpg"
print(img)
 
loc = pyautogui.locateOnScreen(img, confidence=confidence)

#3 print(os.getcwd())
print(loc)
 
