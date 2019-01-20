import os, shutil
import DataCollector
import train
import dataset
import DataAranger

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
def createModelFromJsonfileUrl(url, filePath):
    #Making the main dir that data will be stored in.
    dataFolderPath = os.path.normpath(os.getcwd() + '/CnnModelCreatorData')
    DataCollector.createFolder(dataFolderPath)
    deleteAllFilesInFolderAndSubFolders(dataFolderPath)

    #Downloading and ressizing images
    if url is 0:
        DataCollector.readJsonData(dataFolderPath, 0, filePath)
        data = DataCollector.loadJsonLocalFile(filePath)
    else:
        DataCollector.readJsonData(dataFolderPath, url, 0)
        data = DataCollector.readJsonFromUrl(url)
        

    #Collecting info on how the model should be created.
    validation_size =  data["info"]["validation_size"]
    validation_size = float(validation_size)

    batch_size = data["info"]["batch_size"]
    batch_size = int(batch_size)

    img_size = data["info"]["img_size"]
    img_size = float(img_size)

    num_channels = data["info"]["channels"]
    num_channels = int(num_channels)

    classes = []
    for value in data["categories"].keys():
        classes.append(value)
    num_classes = len(classes)

    num_iteration = data["info"]["iterations"]
    num_iteration = int(num_iteration)

    #hardcorded value.
    train_path = os.normpath(dataFolderPath + '/' + data["info"]["name"])
    modelFolder = os.normpath(train_path + '/modelData')

    ##Network graph params
    filter_size_conv1 = int(data["info"]["filter_size_conv1"])
    num_filters_conv1 = int(data["info"]["num_filters_conv1"])

    filter_size_conv2 = int(data["info"]["filter_size_conv2"])
    num_filters_conv2 = int(data["info"]["num_filters_conv2"])

    filter_size_conv3 = int(data["info"]["filter_size_conv3"])
    num_filters_conv3 = int(data["info"]["num_filters_conv3"])

    fc_layer_size = int(data["info"]["fc_layer_size"])

    #loads the dataset for training 
    dataset.load_train(train_path, img_size, classes);

    #Creates the model and trains the model.
    train.doRun(classes, validation_size, train_path, batch_size, img_size, num_channels, num_iteration, modelFolder, filter_size_conv1, num_filters_conv1, filter_size_conv2, num_filters_conv2, filter_size_conv3, num_filters_conv3, fc_layer_size)



def prepareData(src, dst, categories, dataFolder, itemTag, modelName, maxItems):
    

    #for retesting purposes we delete all files after we are done.
    #deleteAllFilesInFolderAndSubFolders(src) #temperory.
    
    #§dataFolderPath = os.path.normpath(dataFolder)



    #Making the main dir that data will be stored in.
    DataCollector.createFolder(dataFolder)
    subDataFolder = os.path.normpath(src)
    DataCollector.createFolder(subDataFolder)

    dataFolderForDst = os.path.normpath(dst)
    dataFolderForDst = dataFolderForDst + "/"
    DataCollector.createFolder(dataFolderForDst)
    
    dataFolderPathJson = os.path.normpath(dst + '/json//');
    DataCollector.createFolder(dataFolderPathJson)
    
    
    DataAranger.splitJsonDataIntoCategories(src, dataFolderPathJson, categories, itemTag);


    DataAranger.readJsonData2(dataFolderForDst, categories, modelName, dataFolderPathJson, maxItems)

    validation_size = float(0.2)
    batch_size = int(16)
    img_size = float(128)
    num_channels = int(3)
    classes = []

    num_classes = len(categories)

    num_iteration = int(1000)


    train_path = dataFolderForDst
    modelFolder = dataFolderForDst

    ##Network graph params
    filter_size_conv1 = 3
    num_filters_conv1 = 32

    filter_size_conv2 = 3
    num_filters_conv2 = 32

    filter_size_conv3 = 3
    num_filters_conv3 = 64

    fc_layer_size = 128

    train.doRun(categories, validation_size, train_path, batch_size, img_size, num_channels, num_iteration, modelFolder, filter_size_conv1, num_filters_conv1, filter_size_conv2, num_filters_conv2, filter_size_conv3, num_filters_conv3, fc_layer_size)

    
    #readJsonData(src)

    return 0;
    #Maybe delete all trainning images after it's done? Maybe this should only be done if asked for in the info section of the json.

#Testing Area - Running the createModelFromJsonfileUrl with the testData.json file
url = "http://4pi.dk/playground/testjsondata/index.php?fbclid=IwAR3NWUErkGsKorzr7omAkj33PcWqrjMFuyLZyUiMiv2A6H5PdATMvt7cH7c";
#filePath = os.path.normpath(os.getcwd() + '/../../Setup//data_cycling.json');

#createModelFromJsonfileUrl(0, filePath)
#createModelFromJsonFilePath(filePath, 'CnnModelCreatorData');


filePath = 'C:/data_cycling.json';
dst = 'C:/cnnData/topCategoriesTestFamily_3k/';

#itemTag = 'item_group'
#prepareData(filePath, 'C:/cnnData/topCategories', ['cycling_bike', 'clothes_group', 'cycling_component'], 'C:/cnnData', itemTag)
maxItems = 3000;
itemTag = 'item_family'
modelName = 'topCategoriesTestFamily_3k'
prepareData(filePath, dst, ['cycling_bike', 'cycling_clothes', 'cycling_component'], 'C:/cnnData/topCategoriesTest_4', itemTag, modelName, maxItems)