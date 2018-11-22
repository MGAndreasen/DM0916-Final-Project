# Read Json File - Check fileName and see if it's allready downloaded.
# Resize the image 
# Insert image in folder with name of it's categorie.
# Finish.

import cv2


import glob
import datetime

import json
from pprint import pprint   #only used to print out whole json. aka not needed
import os
import urllib
import ImageResizer


#holds each object from json file. 
filePath = os.path.normpath('C:/test/testData.json');

url = "http://4pi.dk/playground/testjsondata/index.php?fbclid=IwAR3NWUErkGsKorzr7omAkj33PcWqrjMFuyLZyUiMiv2A6H5PdATMvt7cH7c";
#url = filePath

def readJsonFromUrl(url): 
    req = urllib.request.Request(url, headers={'User-Agent' : "CNNModelCreator"}) 
    con = urllib.request.urlopen(req)
    text = con.read()
    data = json.loads(text)
    return data

def createFolder(newFolder):
    try:
        # Create target Directory
        os.mkdir(newFolder)
        print("Directory " , newFolder ,  " Created ") 
    except FileExistsError:
        print("Directory " , newFolder ,  " already exists")

    return 0

def downloadImageUrl(filePath, url):
    print("Downloading image: " + url)
    f = open(filePath,'wb')
    req = urllib.request.Request(url, headers={'User-Agent' : "CNNModelCreator"}) 
    con = urllib.request.urlopen(req)
    f.write(con.read())
    f.close()

def getFileNameFromUrl(url):
    fileName = url.split('img=')[-1]
    return fileName
    
def readJsonData(dataFolderPath):
    #data = readJsonFromUrl(url)
    data = loadJsonLocalFile(R'C:\test\testData.json')
    modelName = data["info"]["name"]
    size = data["info"]["size"]
    data = data["categories"]

    for categorie in data.keys():
        newFolder = (dataFolderPath + "/" + modelName);
        createFolder(newFolder)
        newFolder = (dataFolderPath + "/" + modelName + "/" + categorie);
        createFolder(newFolder)

        for object in data[categorie]:
            url = object["url"]
            fileName = getFileNameFromUrl(url)
            filePath = os.path.normpath((dataFolderPath + "/" + modelName + "/" + categorie + "/" + fileName));
            downloadImageUrl(filePath, url)
       
        ImageResizer.resizeImagesInFolder((dataFolderPath + "/" + modelName + "/"+ categorie), size, size, 0, 0, cv2.INTER_LINEAR)

def loadJsonLocalFile(filePath):
    with open(filePath) as file:
        data = json.load(file)
    return data

#Methods not currently in use
def printJson(filePath):
    with open(filePath) as file:
        data = json.load(file)
    pprint(data)
    return data


#folderPath, col, row, scaleFactorHorizontal, scaleFactorVertical, interpolationMethod, dst