import tensorflow as tf
import numpy as np
import os,glob,cv2
import sys,argparse
import datetime

##the image_size and num_channels have to be the same as the modelCreatar as we are restoring the exact same graph. 
#Maybe we should have it in the modelTable, what img_size, classes, num_channels, and so on. That way the image predictor would
#know the right configs.
def restoreGraph(model_path, latestCheckpoint_path):
    #Restoring the saved model 
    sess = tf.Session()
    
    #Recreating the network graph.
    saver = tf.train.import_meta_graph(model_path)

    #Loading the weights saved using the restore method.
    saver.restore(sess, tf.train.latest_checkpoint(latestCheckpoint_path))

    return sess;

def runPridict(image_path, image_size, num_channels, sess):
    #dir_path = os.path.dirname(os.path.realpath(__file__))
    #image_path=sys.argv[1] 
    filename = image_path
    #image_size=128         <--input parameter
    #num_channels=3         <--input parameter
    images = []
    # Reading the image using OpenCV
    image = cv2.imread(filename)
    # Resizing the image to the desired size and preprocessing exactly as during training
    image = cv2.resize(image, (image_size, image_size),0,0, cv2.INTER_LINEAR)
    images.append(image)
    images = np.array(images, dtype=np.uint8)
    images = images.astype('float32')
    images = np.multiply(images, 1.0/255.0) 

    #The input to the network is of shape [None image_size image_size num_channels]. Hence we reshape.
    x_batch = images.reshape(1, image_size,image_size,num_channels)

    # Accessing the default graph which is just restored
    graph = tf.get_default_graph()

    # y_pred is the tensor that is the prediction of the network
    y_pred = graph.get_tensor_by_name("y_pred:0")

    # Feeding the images to the input placeholders
    x= graph.get_tensor_by_name("x:0") 
    y_true = graph.get_tensor_by_name("y_true:0") 
    y_test_images = np.zeros((1, 3)) 

    
    ### Creating the feed_dict that is required to be fed to calculate y_pred 
    feed_dict_testing = {x: x_batch, y_true: y_test_images}
    result=sess.run(y_pred, feed_dict=feed_dict_testing)

    # result is of this format [probabiliy_of_bike probability_of_component probability_of_cloth]
    #this foreach loop is realy only to print out the number nicer, instead of 1.0000032e-9 which is super close to zero anywayys.
    for r in result:
        num1 = float('{:.2f}'.format(float(r[0])))
        num2 = float('{:.2f}'.format(float(r[1])))
        num3 = float('{:.2f}'.format(float(r[2])))
        if num1 < 0.01:
           num1 = 0.0
        if num2 < 0.01:
           num2 = 0.0
        if num3 < 0.01:
           num3 = 0.0
        print("bike: ", num1, " | cloth: ", num2, " | component: ", num3, " | ")

    return(result)

def runPredictArray(imagePaths, model_path, latestCheckpoint_path, image_size = 128, num_channels = 3):
    sess = restoreGraph(model_path, latestCheckpoint_path);

    #Resizing the image to the desired size and preprocessing exactly as during training
    for path in imagePaths:
        images = []
        image = cv2.imread(path)    
        image = cv2.resize(image, (image_size, image_size),0,0, cv2.INTER_LINEAR)
        images.append(image)

        images = np.array(images, dtype=np.uint8)
        images = images.astype('float32')
        images = np.multiply(images, 1.0/255.0) 

        #The input to the network is of shape [None image_size image_size num_channels]. Hence we reshape.
        x_batch = images.reshape(1, image_size,image_size,num_channels)

        # Accessing the default graph which is just restored
        graph = tf.get_default_graph()

        # y_pred is the tensor that is the prediction of the network
        y_pred = graph.get_tensor_by_name("y_pred:0")

        # Feeding the images to the input placeholders
        x= graph.get_tensor_by_name("x:0") 
        y_true = graph.get_tensor_by_name("y_true:0") 
        y_test_images = np.zeros((1, 3)) 

    
        ### Creating the feed_dict that is required to be fed to calculate y_pred 
        feed_dict_testing = {x: x_batch, y_true: y_test_images}
        result=sess.run(y_pred, feed_dict=feed_dict_testing)

        # result is of this format [probabiliy_of_bike probability_of_component probability_of_cloth]
        #this foreach loop is realy only to print out the number nicer, instead of 1.0000032e-9 which is super close to zero anywayys.
        for r in result:
            num1 = float('{:.2f}'.format(float(r[0])))
            num2 = float('{:.2f}'.format(float(r[1])))
            num3 = float('{:.2f}'.format(float(r[2])))
            if num1 < 0.01:
               num1 = 0.0
            if num2 < 0.01:
               num2 = 0.0
            if num3 < 0.01:
               num3 = 0.0
            print(path, " = ", "bike: ", num1, " | cloth: ", num2, " | component: ", num3, " | ")

    return(result)

def testingArrayPredict(folderPath):
    model_path              = R'C:\cnnData\topCategoriesTestFamily_3k\.meta'
    latestCheckpoint_path   = R'C:\cnnData\topCategoriesTestFamily_3k'
    images = []

    for the_file in os.listdir(folderPath):
        file_path = os.path.join(folderPath, the_file)
        images.append(file_path)
    



    #images = {R"C:\Users\Chris\OneDrive\Skrivebord\a.jpg", R"C:\Users\Chris\OneDrive\Skrivebord\b.jpg", R"C:\Users\Chris\OneDrive\Skrivebord\c.jpg"};
              #R"C:\Users\Chris\OneDrive\Skrivebord\d.jpg", R"C:\Users\Chris\OneDrive\Skrivebord\e.jpg", R"C:\Users\Chris\OneDrive\Skrivebord\f.jpg",
              #R"C:\Users\Chris\OneDrive\Skrivebord\g.jpg", R"C:\Users\Chris\OneDrive\Skrivebord\h.jpg", R"C:\Users\Chris\OneDrive\Skrivebord\i.jpg",
              #R"C:\Users\Chris\OneDrive\Skrivebord\l.jpg", R"C:\Users\Chris\OneDrive\Skrivebord\n.jpg", R"C:\Users\Chris\OneDrive\Skrivebord\m.jpg",
              #R"C:\Users\Chris\OneDrive\Skrivebord\o.jpg", R"C:\Users\Chris\OneDrive\Skrivebord\p.jpg", R"C:\Users\Chris\OneDrive\Skrivebord\p1.jpg",};

    runPredictArray(images, model_path, latestCheckpoint_path);

def testingSinglePredict():
    model_path              = R'C:\cnnData\topCategoriesTest_100.meta'
    latestCheckpoint_path   = R'C:\cnnData'
    image_size = 128
    num_channels = 3
    #Recreating the network graph.
    sess = restoreGraph(model_path, latestCheckpoint_path);
    
    runPridict(R"C:\Users\Chris\OneDrive\Skrivebord\a.jpg", image_size, num_channels, sess);
    runPridict(R"C:\Users\Chris\OneDrive\Skrivebord\b.jpg", image_size, num_channels, sess);
    runPridict(R"C:\Users\Chris\OneDrive\Skrivebord\c.jpg", image_size, num_channels, sess);
    runPridict(R"C:\Users\Chris\OneDrive\Skrivebord\d.jpg", image_size, num_channels, sess);
    runPridict(R"C:\Users\Chris\OneDrive\Skrivebord\e.jpg", image_size, num_channels, sess);
    runPridict(R"C:\Users\Chris\OneDrive\Skrivebord\f.jpg", image_size, num_channels, sess);
    runPridict(R"C:\Users\Chris\OneDrive\Skrivebord\g.jpg", image_size, num_channels, sess);
    runPridict(R"C:\Users\Chris\OneDrive\Skrivebord\h.jpg", image_size, num_channels, sess);
    runPridict(R"C:\Users\Chris\OneDrive\Skrivebord\i.jpg", image_size, num_channels, sess);
    runPridict(R"C:\Users\Chris\OneDrive\Skrivebord\j.jpg", image_size, num_channels, sess);
    runPridict(R"C:\Users\Chris\OneDrive\Skrivebord\k.jpg", image_size, num_channels, sess);

#Testing Area.
folder1 = R"C:\Users\Chris\OneDrive\Skrivebord\testHelmet"
folder2 = R"C:\Users\Chris\OneDrive\Skrivebord\testMTB"
folder3 = R"C:\Users\Chris\OneDrive\Skrivebord\testTire"

testingArrayPredict(folder1);
testingArrayPredict(folder2);
testingArrayPredict(folder3);