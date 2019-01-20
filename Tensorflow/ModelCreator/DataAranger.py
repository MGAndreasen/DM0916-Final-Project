import cv2
import glob
import datetime

import json
from pprint import pprint   #only used to print out whole json. aka not needed
import os
import urllib
import ImageResizer

def createFolder(newFolder):
    try:
        # Create target Directory
        os.mkdir(newFolder)
        print("Directory " , newFolder ,  " Created ") 
    except FileExistsError:
        print("Directory " , newFolder ,  " already exists")

    return 0

def downloadImageUrl(filePath, url):
    try:
        req = urllib.request.Request(url, headers={'User-Agent' : "SchoolProject"}) 
        con = urllib.request.urlopen(req)
        f = open(filePath,'wb')
        f.write(con.read())
        f.close()
        print("Downloaded image: " + url)
        return 1;
    except:
        print("Could not download image " + url)
        return 0;

def loadJsonLocalFile(filePath):
    with open(filePath, encoding='utf8') as file:
        data = json.load(file)
    return data

def getFileNameFromUrl(url):
    fileName = url.split('img=')[-1]
    return fileName
   
#Temp.
def splitJsonDataIntoCategories(src, dst, categories, itemTag):
    data = loadJsonLocalFile(src);
    
    for category in categories:
        jsonArray = []
        id = 0
        for product in data:
            if product.get(itemTag) == str(category):
                jsonObject = dict()
                id += 1
                jsonObject['id'] = str(id)
                jsonObject["projectId"] = '1'
                jsonObject["url"] = product.get("item_image_url")
                jsonArray.append(jsonObject)

        with open(dst + '/'+str(category)+'.json', 'w') as outfile:
            json.dump(jsonArray, outfile)
    return 0;


def readJsonData2(dataFolderPath, categories, modelName, dataFolderPathJson, maxItems):
    
    size = 128
    

    for category in categories:
        createFolder(dataFolderPath + "/" + category)

        data = loadJsonLocalFile(dataFolderPathJson+"/"+category+'.json')
        i = 0
        for object in data:
            if i > maxItems:
                break;
            url = object["url"]
            fileName = object["id"]+'.jpg'
            filePath = os.path.normpath(dataFolderPath + "/" + category + "/" + fileName);
            filePathDst = os.path.normpath(dataFolderPath + "/" + category + "/");
            if url is not None:
                succes = downloadImageUrl(filePath, url)
                if succes == 1:
                    pprint(filePath)
                    pprint(size)
                    pprint(filePathDst)
                    ImageResizer.resizeSingleImage(filePath, size, size, 0, 0, cv2.INTER_LINEAR, filePath)
                    i += 1
                    #filePath, col, row, scaleFactorHorizontal, scaleFactorVertical, interpolationMethod, dst):
    return 0

def readJsonData(dataFolderPath, url, filePath):

    if url is 0:
        data = loadJsonLocalFile(filePath)
    else:
        data = readJsonFromUrl(url)
    
    #Getting data from info field in json.
    modelName = data["info"]["name"]
    size = data["info"]["img_size"]

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



#Methods not currently in use
def printJson(filePath):
    with open(filePath) as file:
        data = json.load(file)
    pprint(data)
    return data


#folderPath, col, row, scaleFactorHorizontal, scaleFactorVertical, interpolationMethod, dst