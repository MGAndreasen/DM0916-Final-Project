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


#Testing Area
dataFolderPath = os.path.normpath('C:/CnnModelCreatorData');
deleteAllFilesInFolderAndSubFolders(dataFolderPath)
DataCollector.readJsonData(dataFolderPath);


#Setting up for training with hardcorded values for now.

# 20% of the data will automatically be used for validation
validation_size = 0.2
train_path=R"C:\modelCreatorData";
batch_size = 5
img_size = 128
num_channels = 3

#Prepare input data
classes = ['bmx', 'city', 'mtb']
num_classes = len(classes)
num_iteration = 2

modelFolder = R"C:\CnnModelCreatorData\bikes"

train_path=R"C:\CnnModelCreatorData\bikes"
image_size = 128
classes = ['city', 'bmx', 'mtb']
dataset.load_train(train_path, image_size, classes);

train.doRun(classes, validation_size, train_path, batch_size, img_size, num_channels, num_iteration, modelFolder)