import os,glob,cv2
import shutil
from PIL import Image
import numpy as np

#This script should maybe be in its own .py project as its purpose is only to manipulate images so they will be the correct size for a cnn network.

#scale factor along the horizontal axis
def resizeSingleImage(filePath, col, row, scaleFactorHorizontal, scaleFactorVertical, interpolationMethod, dst):
    #finds the file name in filepath
    filePathSplitted = str(filePath).split('\\', -1)
    lastSplit = filePath.count('\\')
    orginalFileName = filePathSplitted[lastSplit] 

    newFileName = '\\resized_'+ str(col) + '-' + str(row) + '_' + str(interpolationMethod) + orginalFileName
    newFilePath = dst + newFileName;
    
    if interpolationMethod == cv2.INTER_LINEAR:
        interpolationMethodStr = 'Inter_Linear';
    if interpolationMethod == cv2.INTER_LINEAR_EXACT:
        interpolationMethodStr = "Inter_Linear_Exact";

    #Check if its allready in folder
    if os.path.isfile(newFilePath):
        print(newFileName, 'allready exixst')
    else:
        shutil.copy(filePath, newFilePath)
        image = cv2.imread(newFilePath, 1)
        newImage = cv2.resize(image, (col, row), scaleFactorHorizontal, scaleFactorVertical, interpolationMethod)
        cv2.imwrite(newFilePath, newImage)
   

#Testing Area.
imagePath =  R"C:\Users\Chris\OneDrive\Skrivebord\e.jpg";
dst =         "C:\\Users\\Chris\\OneDrive\\Skrivebord\\";
resizeSingleImage(imagePath, 128, 128, 0, 0, cv2.INTER_LINEAR_EXACT, dst)