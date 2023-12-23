import cv2
import numpy as np

#pip install opencv-python
#pip install  pyautogui

# 这个3.png是大图，需要在这张图片中寻找目标的
img_rgb = cv2.imread('C:/0prj/lhc2023/big.jpg')
# Convert it to grayscale
img_gray_bigpic = cv2.cvtColor(img_rgb, cv2.COLOR_BGR2GRAY)

# C:\Users\attil\AppData\Local\Programs\Python\Python312\Scripts\pip.exe

# 这个1.png是小图，是图中的目标
template = cv2.imread('C:/0prj/lhc2023/startPic.jpg',0)
# Store width and heigth of template in w and h
w, h = template.shape[::-1]
# Perform match operations.
res = cv2.matchTemplate(img_gray_bigpic,template,cv2.TM_CCOEFF_NORMED)
print('mt rate=>')
print(res)

# Specify a threshold
# 这里的0.7表示匹配度
threshold = 0.7
# Store the coordinates of matched area in a numpy array
loc = np.where(res >= threshold)
x=loc[0]
y=loc[1]
# Draw a rectangle around the matched region.
if len(x) and len(y):
    for pt in zip(*loc[::-1]):
        # 这里会把匹配到的位置用矩形框给框选出来
        print(pt)
        cv2.rectangle(img_rgb, pt, (pt[0] + w, pt[1] + h), (0,255,255), 2)
        cv2.imwrite("C:/0prj/lhc2023/rzt.png", img_rgb)
        print('I found the watermark')
else:
    print('there is no watermark')