import os, shutil
import DataCollector
import train
import dataset

#To Do: insert the different sizes in the info json file, also move the session to "bikes" folder.
#aka. clean up the hardcorded values in #Testing Area and make it so only one function can run it all, rest should come from json file info.

def deleteAllFilesInFolderAndSubFolders(folder):
    print("Deleting files in folder: " + folder)
    for the_file in os.listdir(folder):
        file_path = os.path.join(folder, the_file)
        try:
            if os.path.isfile(file_path):
                os.unlink(file_path)
            elif os.path.isdir(file_path): shutil.rmtree(file_path)
        except Exception as e:
            print(e)


#This is the main method for setting the whole ModelCreator project in motion.
def createModelFromJsonfileUrl(url = 0, filePath = 0):
    #Downloading and ressizing images
    dataFolderPath = os.path.normpath('C:/CnnModelCreatorData')
    deleteAllFilesInFolderAndSubFolders(dataFolderPath)

    if url is not 0:
        DataCollector.readJsonData(dataFolderPath, url, 0)
    else:
        DataCollector.readJsonData(dataFolderPath, 0, filePath)

    #Collecting info on how the model should be created.
    data = DataCollector.readJsonFromUrl(url)
    data = DataCollector.loadJsonLocalFile(R'C:\test\testData.json')
    validation_size =  data["info"]["validation_size"]
    batch_size = data["info"]["batch_size"]
    img_size = data["info"]["img_size"]
    num_channels = data["info"]["channels"]
    classes = []
    for value in data["categories"].keys():
        classes.append(value)
    num_classes = len(classes)
    num_iteration = data["info"]["iterations"]

    #hardcorded value.
    CnnModelFolder = R"C:\CnnModelCreatorData"
    modelFolder = os.path.normpath(CnnModelFolder + '/' + data["info"]["name"]);
    train_path = modelFolder

    #loads the dataset for training 
    dataset.load_train(train_path, img_size, classes);

    #Creates the model and trains the model.
    train.doRun(classes, validation_size, train_path, batch_size, img_size, num_channels, num_iteration, modelFolder)

    #Maybe delete all trainning images after it's done? Maybe this should only be done if asked for in the info section of the json.

#Testing Area
url = "http://4pi.dk/playground/testjsondata/index.php?fbclid=IwAR3NWUErkGsKorzr7omAkj33PcWqrjMFuyLZyUiMiv2A6H5PdATMvt7cH7c";
filePath = os.path.normpath('C:/test/testData.json');

createModelFromJsonfileUrl(0, filePath)