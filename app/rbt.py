

import pyautogui
import time

# move is syodwei d ,move to is abslt
pyautogui.moveTo(300,500)

 
 #down scrl 
pyautogui.scroll(-10000*9999) 
pyautogui.scroll(-10000*9999) 
pyautogui.scroll(-10000*9999) 

count = 0
while (count < 9):
   pyautogui.scroll(-999) 
   time.sleep(0.1)
   
 

# 距离。如果传入正数，则表示鼠标向上滚动，反之则表示鼠标向下滚动。该方法还支持指定滚动速度、滚动位置等参数，可以根据具体需求进行调整。
