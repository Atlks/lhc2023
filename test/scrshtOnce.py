import time
# C:\Users\u\AppData\Local\Programs\Python\Python312\python.exe scrsht.py
# C:\Users\u\AppData\Local\Programs\Python\Python312\Scripts\pip install numpy
# C:\Users\u\AppData\Local\Programs\Python\Python312\Scripts\pip install pyautogui
# Pillow  pyscreeze.

import numpy as np
import pyautogui
#import cv2
def scrsht():
    img = pyautogui.screenshot(region=[0, 0, 900, 1000])  # x,y,w,h
    # img.save('screenshot.png')
    # img = cv2.cvtColor(np.asarray(img), cv2.COLOR_RGB2BGR)

    nowtime = time.strftime('%Y_%m_%d_%H_%M_%S', time.localtime(time.time()))

    print(nowtime)
    img.save(nowtime + 'screenshot.png')

 

print("截图！")

scrsht()

# C:\lhc2023\Python312\python.exe C:\lhc2023\test\scrshtOnce.py

 

  