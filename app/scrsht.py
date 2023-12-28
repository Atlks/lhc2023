import time

import numpy as np
import pyautogui
import cv2
def scrsht():
    img = pyautogui.screenshot(region=[0, 0, 900, 1000])  # x,y,w,h
    # img.save('screenshot.png')
    # img = cv2.cvtColor(np.asarray(img), cv2.COLOR_RGB2BGR)

    nowtime = time.strftime('%Y_%m_%d_%H_%M_%S', time.localtime(time.time()))

    print(nowtime)
    img.save(nowtime + 'screenshot.png')

while True:

    print("截图！")

    scrsht()



    print("暂停")

    print("\n")

    time.sleep(3) #定时10s看一下

