#include <iostream>
#include <math.h>
#include <stdlib.h>
#include <fstream>
#include "opencv\cv.h"
#include "opencv\highgui.h"
#include "opencv\ml.h"

using namespace cv;
using namespace std;

#define TARGET 1

float p,a;
float label,out,value;

//Fungsi Mencari RMSE
float evaluate(Mat &predicted, Mat &actual,int TEST_SAMPLES)
{
    float tot=0.0;
    for(int m=0; m<TEST_SAMPLES; m++)
    {
        p = predicted.at<float>(m,0);
        a = actual.at<float>(m,0);
        tot=tot+((a-p)*(a-p));
    }
    float rmse=sqrt(tot/(TEST_SAMPLES-1));
    return rmse;
}

//Fungsi mencari akurasi prediksi
float accuracy(Mat &predicted, Mat &actual,int TEST_SAMPLES)
{
    float MAPE=0.00;
    float accuracy;
    for(int q=0; q<TEST_SAMPLES; q++)
    {
        p = predicted.at<float>(q,0);
        a = actual.at<float>(q,0);
        MAPE=(((abs(a-p)/a)/TEST_SAMPLES)*100)+MAPE;
    }
    accuracy=100-MAPE;
    return accuracy;
}

//Fungsi membaca data dan mengkonversi ke bentuk matrix
void bacaData(char* filename,Mat &Dat, Mat &out,int total_samples,int attrib)
{
    FILE* file=fopen(filename,"r");

    for(int row = 0; row < total_samples; row++)
    {
        for(int col = 0; col <=attrib; col++)
        {
            if (col < attrib)
            {
                fscanf(inputfile, "%f,", &value);
                Dat.at<float>(row,col) = value;
            }

            else if (col==attrib)
            {
                fscanf(inputfile, "%f", &label);
                out.at<float>(row,0) = label;

            }
        }
    }
    fclose(file);

}

int main(int argc, char* argv[])
{
    /**** Create Matrix ****/
    //INPUT
    Mat trainingDat(atoi(argv[1]),atoi(argv[10]),CV_32FC1);
    //TRAINING TARGET
    Mat trainingOut(atoi(argv[1]),TARGET,CV_32FC1);
    //TESTING INPUT AND TARGET
    Mat testingDat(atoi(argv[9]),atoi(argv[10]),CV_32FC1);
    Mat testingOut(atoi(argv[9]),TARGET,CV_32FC1);
    //testing data
    Mat predicted(testingOut.rows,1,CV_32F);
    Mat testOut(1,TARGET,CV_32FC1);
    Mat sample;

    //Fungsi membaca data dan mengubah ke matrix
    bacaData(argv[7],trainingDat,trainingOut,atoi(argv[1]),atoi(argv[10]));
    bacaData(argv[8],testingDat,testingOut,atoi(argv[9]),atoi(argv[10]));

    //Membuat Layer dalam Model ANN
    Mat layers(3,1,CV_32S);
    layers.at<int>(0,0)=atoi(argv[10]);//input layer
    layers.at<int>(1,0)=atoi(argv[2]);//hidden layer
    layers.at<int>(2,0) =TARGET;//output layer

    //Membuat model ANN
    CvANN_MLP nnetwork(layers,CvANN_MLP::SIGMOID_SYM,1,1); //see row 134 in C:\opencv\sources\modules\ml\src\ann_mlp.cpp
    CvANN_MLP_TrainParams params(
    cvTermCriteria(CV_TERMCRIT_ITER+CV_TERMCRIT_EPS,atoi(argv[3]),atof(argv[4])),
    //  CvTermCriteria _term_crit,
    CvANN_MLP_TrainParams::BACKPROP,  //_train_method,bisa diganti ke RPROP
    atof(argv[5]), //double _param1,
    atof(argv[6]));//double _param2 )

    //Pelatihan model ANN
    int iterations= nnetwork.train(trainingDat, trainingOut,Mat(),Mat(),params);
    //int iterations= jumlah epoch yang diperlukan sampai batas toleransi error

    //Prediksi data uji
    for(int k=0; k<testingDat.rows; k++){
            sample= testingDat.row(k);
            nnetwork.predict(sample,testOut);
            predicted.at <float>(k,0)=testOut.at<float>(0,0);
    }

    //Print Evaluasi Model
    cout<<setprecision(2);
    //RMSE
    cout<<evaluate(predicted,testingOut,atoi(argv[9]))<<endl;
    cout<<fixed<<setprecision(1);
    //Akurasi
    cout<<accuracy(predicted,testingOut,atoi(argv[9]))<<endl;
    //Hasil Prediksi
    for(int k=0; k<testingDat.rows; k++)
    {
        cout<<fixed<<setprecision(2)<<predicted.at <float>(k,0)<<endl;
    }

    return 0;
}


