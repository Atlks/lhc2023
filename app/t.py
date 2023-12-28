print(11111)

import sys


sys.path.append('C:\\Users\\attil\\AppData\\Local\\Programs\\Python\\Python312\\Lib\\site-packages')
sys.path.append('C:\\0prj\\lhc2023\\venv\\Lib\\site-packages')


print(sys.path)


import os
dir123=os.path.dirname(os.path.realpath('__file__'))#注意：添加单引号
print(dir123)