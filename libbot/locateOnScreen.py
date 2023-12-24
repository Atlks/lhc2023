



import time
import os
import sys
# pip install pyscreeze
# pip install pyautogui
# pip install PIL


# --------------- invk in js------
sys.path.append('D:\\python_module')
sys.path.append('C:\\Users\\attil\\AppData\\Local\\Programs\\Python\\Python312\\Lib\\site-packages')
sys.path.append('C:\\0prj\\lhc2023\\venv\\Lib\\site-packages')

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
arg338=sys.argv[1]
print('args:'+arg338)



# urldecode
#url=urllib.parse.unquote(arg338)

#print(url)
parsed = urlparse.urlparse('?'+arg338)
querys = urlparse.parse_qs(parsed.query)
print(querys)
#quit()

#quit()
confidence=querys['confidence'][0]
region_raw=querys['region'][0]
region_raw_a= region_raw.  split(",")
region=(int(region_raw_a[0]),int(region_raw_a[1]), int(region_raw_a[2]),int( region_raw_a[3]))


grayscale=querys['grayscale'][0]
if(grayscale=="true"):
    grayscale=True
else:
    grayscale= False
img=querys['img'][0]
loc = pyautogui.locateOnScreen(img, confidence=confidence, region=region, grayscale=grayscale)

#3 print(os.getcwd())
print(loc)