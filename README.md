<h1>Nitrogen Estimation of Paddy Based on Leaf Reflectance Using Artificial Neural Network (ANN)</h1>

<h2> Introduction </h2>
Nitrogen (N) is one of nutrient required by plant in huge amounts. N availability of plant is needed to be estimated before applying fertilizers to determine proper N application rate. The purpose of this study is to estimate N of paddy (Oryza sativa, sp.) based on leaf reflectance using Artificial Neural Network (ANN). In this study, 45 leaf samples were randomly
selected under various environmental condition. Leaf reflectance was measured by handheld spectroradiometer while actual leaf N content was determined by Kjeldahl method. Spectral reflectance data in visible band (400-700 nm
wavelength region) and actual N content were used as input and target data in ANN model building. K-fold crossvalidation(k=3) method was applied to select the best model and measure the overall performance of model. Results
indicated that ANN model with 17 neurons of hidden layer in relatively could estimate N properly. It was shown by the lowest root mean square error (RMSE) of 0.23 and the highest prediction accuracy of 93%. This study promises to help farmers predicting N content of paddy for optimal N fertilizer application.

<h3>Notes</h3>
This repository is intended for development purpose. Feel free to join us

<h2> Prerequisites </h2>
<p>In this repository, I integrate OpenCV with Code Block and MinGW on Windows.</p>
<b>Step 1: Install </b><code>MinGW</code>
<p><code>MinGW</code> is a c/c++ compiler for windows, head to their website and download the latest version in <a href="http://sourceforge.net/projects/mingw/files/">here</a>
</p>
<ul>
<li>Install to the default location <code>C:\MinGW</code></li>
<li>Make sure that you also add <code>minGW</code> to system path by navigating to <code>Control Panel -> System -> Advanced -> Environment Varibles</code></li>
<li>Edit path in system variables and type a semi colon after the last entry in path. Afterward, paste your MinGW path (it might be <code> C:\MinGW\bin </code> if you chose the default location as I've mentioned before).</li>
</ul>
<b>Step 2: Install </b> <code>Code::Blocks</code>
<p><code>Code::Blocks</code> is an IDE (integrated development environment). Head to their website and download the latest version in <a href="www.codeblocks.org">here</a></p>
<p><b>Step 3: Install </b> <code>OpenCV</code></p>
<p>OpenCV is a library of Computer Vision functions. Head to their website and download the latest version (Minimum: OpenCV 2.2) in <a href="www.opencv.org">here</a></p>


<h2>Documentation </h2>
<p>This repository contain 2 datasets for training model, C++ file as backend, and front end using PHP and Twitter Bootstrap template. </p>
<h3>1. Data Preprocessing</h3>
<p>I have 2 datasets: training and testing test (.txt). It is located in <code>EstimationNitrogenANN/pages/</code></p>
<p>I divide the data using k-fold cross validation with k=3. Training set has 30 samples (30 rows) and Testing set has 15 samples (15 rows). Only spectral reflectance value from 400-700 nm (visible wavelength region) were used. Each sample has 301
reflectance data that used as attributes and 1 nitrogen Kjeldahl value (%) as a target (actual output). A total of 302 values was arranged in a single line at txt file extension. Each value was separated by a comma (,)
<h4>Training Set</h4>
</p>
<p>One rows (features and actual output) will look like this:</p>
<pre>
<code>
0.0268,0.02769,0.02889,0.02927,0.02892,0.03057,0.03267,0.03318,0.03337,0.03369,0.03448,0.03564,0.03695,0.03709,0.03668,0.03726,0.03853,0.04016,0.04099,0.04117,0.04101,0.04161,0.04291,0.04362,0.04452,0.04592,0.04584,0.04505,0.04576,0.04646,0.04669,0.04692,0.04733,0.04808,0.04867,0.04895,0.04878,0.04865,0.04885,0.04932,0.04983,0.04996,0.04972,0.04937,0.05024,0.05121,0.05094,0.0508,0.05103,0.05147,0.05167,0.05141,0.05148,0.05181,0.05201,0.05227,0.05258,0.05254,0.0525,0.05289,0.05298,0.05272,0.05247,0.05242,0.05266,0.05273,0.05268,0.05293,0.05285,0.05238,0.05262,0.05313,0.05322,0.05324,0.05325,0.05325,0.05325,0.05327,0.05315,0.05303,0.05335,0.05361,0.05361,0.05358,0.0536,0.05374,0.05391,0.05405,0.05402,0.05412,0.05452,0.05446,0.05419,0.05468,0.05546,0.05627,0.05667,0.05686,0.05717,0.05804,0.05933,0.0599,0.06036,0.06122,0.06212,0.06312,0.06453,0.06609,0.06762,0.06861,0.06969,0.07181,0.07393,0.07582,0.07775,0.07992,0.0825,0.08519,0.08783,0.09006,0.0928,0.09619,0.09866,0.10088,0.10399,0.10683,0.1092,0.1117,0.11408,0.11614,0.11823,0.12017,0.12129,0.12259,0.12437,0.1256,0.12656,0.12783,0.12841,0.1284,0.1293,0.13027,0.13056,0.13086,0.13132,0.13203,0.13261,0.13293,0.13342,0.13389,0.13396,0.13418,0.13454,0.1344,0.13409,0.13385,0.13335,0.1327,0.13238,0.13173,0.13051,0.12937,0.12814,0.12641,0.12487,0.12362,0.12228,0.12084,0.11927,0.1174,0.1154,0.11378,0.11211,0.1103,0.10881,0.10747,0.10603,0.10441,0.10273,0.10134,0.1003,0.09958,0.09861,0.09742,0.09637,0.09554,0.09496,0.09443,0.09386,0.09311,0.09261,0.09241,0.0921,0.09178,0.09148,0.09104,0.09048,0.08992,0.08926,0.08848,0.08766,0.08699,0.08671,0.08641,0.086,0.08561,0.08506,0.0843,0.08394,0.08385,0.08342,0.08274,0.08193,0.08158,0.08103,0.07941,0.07858,0.07859,0.07757,0.07668,0.07664,0.07656,0.07619,0.0753,0.07469,0.07459,0.07453,0.07437,0.07407,0.07416,0.07449,0.07434,0.07405,0.07376,0.07315,0.07252,0.07246,0.07193,0.07086,0.07038,0.06995,0.06904,0.06827,0.06771,0.06719,0.06651,0.06557,0.06464,0.06391,0.06362,0.06322,0.06259,0.06192,0.06163,0.06194,0.06151,0.06053,0.06025,0.05993,0.05936,0.0588,0.05805,0.05689,0.05647,0.05663,0.05585,0.055,0.05462,0.05455,0.05473,0.05506,0.05556,0.05615,0.05649,0.05665,0.05672,0.05734,0.05847,0.0596,0.06034,0.06068,0.06208,0.06366,0.06397,0.06506,0.06722,0.06944,0.07149,0.07306,0.0755,0.07839,0.08072,0.0839,0.08841,0.09324,0.09855,0.10437,0.11056,0.11738,0.12502,0.13319,3.4
</code>
</pre>
<b>3.4</b> is actual output (percentage of nitrogen content)
<h4>Testing Set</h4>
<p>while the testing set will look like this</p>
<pre>
<code>
0.06664,0.06699,0.06875,0.06973,0.06947,0.06938,0.07034,0.07326,0.07566,0.07696,0.07756,0.07812,0.07918,0.08145,0.08387,0.08405,0.08471,0.08644,0.08719,0.08767,0.08886,0.09015,0.09116,0.09108,0.09124,0.09246,0.09361,0.09458,0.09569,0.09566,0.0946,0.0957,0.09689,0.09573,0.0953,0.09575,0.09563,0.09526,0.09484,0.09448,0.09425,0.09442,0.09357,0.09178,0.09168,0.09189,0.09078,0.0901,0.09002,0.08987,0.08968,0.08947,0.08908,0.08869,0.08872,0.08841,0.08761,0.0871,0.0868,0.08655,0.08613,0.08562,0.08548,0.08527,0.08474,0.08452,0.08447,0.08401,0.0835,0.08312,0.08294,0.08291,0.08298,0.08284,0.08247,0.08208,0.08173,0.08148,0.08158,0.08178,0.08141,0.08094,0.08064,0.08091,0.08124,0.08084,0.08065,0.08084,0.0811,0.08117,0.08094,0.08121,0.08173,0.08158,0.08156,0.08197,0.08255,0.0832,0.08383,0.08456,0.08535,0.08596,0.08686,0.0884,0.08962,0.09062,0.09207,0.09396,0.09623,0.09845,0.10062,0.10285,0.10534,0.10823,0.11159,0.1153,0.11923,0.12321,0.12731,0.13177,0.13638,0.14111,0.14612,0.15121,0.15604,0.16091,0.16585,0.17079,0.17553,0.17987,0.18422,0.1884,0.19183,0.19507,0.19834,0.20145,0.2042,0.20631,0.20815,0.20988,0.21165,0.2132,0.21434,0.21528,0.21619,0.21743,0.21837,0.21881,0.21939,0.21989,0.21987,0.21979,0.21975,0.21968,0.21912,0.21775,0.21612,0.21451,0.21325,0.2119,0.21022,0.20814,0.20595,0.20409,0.20223,0.20022,0.19787,0.19537,0.19286,0.19045,0.18806,0.18549,0.1828,0.18007,0.17754,0.17507,0.17248,0.16967,0.16674,0.16419,0.16145,0.15809,0.15482,0.15194,0.14988,0.14732,0.14386,0.14071,0.13766,0.13432,0.13158,0.12954,0.12704,0.12498,0.12397,0.12378,0.12426,0.12518,0.12665,0.12856,0.13018,0.1314,0.13214,0.1321,0.13113,0.12919,0.12659,0.12359,0.12059,0.11774,0.11522,0.11243,0.10914,0.10563,0.10193,0.09806,0.09442,0.09115,0.0883,0.08566,0.08314,0.08117,0.07969,0.07841,0.07774,0.07779,0.0786,0.07966,0.08047,0.08142,0.08253,0.08373,0.0847,0.08524,0.08551,0.08539,0.08463,0.08394,0.08327,0.08149,0.07943,0.07785,0.07631,0.07457,0.07231,0.06979,0.06719,0.06473,0.06262,0.06103,0.06031,0.06019,0.05954,0.05838,0.05682,0.05566,0.05487,0.05415,0.05377,0.05371,0.05385,0.05369,0.05274,0.05182,0.05107,0.0501,0.04937,0.04911,0.04888,0.04855,0.04794,0.04792,0.04848,0.04827,0.04816,0.049,0.04978,0.05034,0.05083,0.05139,0.05211,0.05301,0.05413,0.05554,0.0566,0.05748,0.05968,0.06232,0.06428,0.06591,0.06755,0.06981,0.07304,0.07742,0.08197,0.0868,0.09198,0.0976,0.10402,0.11153,0.11945,2.82
</code>
</pre>
<h3>2. Code</h3>
<p>To see the .cpp file, open <code>EstimationNitrogenANN/pages/main.cpp</code>. It will result like this:</p>
<pre>
<code>
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
....
</code>
</pre>
You can also see the docummentation within the file here. 
<h2>How to Run</h2>
<p>First, compile the <code>main.cpp</code> file.You will have two outputs:
<br>1. <code>ann.exe</code> which is located in <code>EstimationNitrogenANN/pages/bin/Debug/</code> and
<br>2. <code>main.o</code> which is located in <code>EstimationNitrogenANN/pages/obj/Debug/</code>
</p>
<p>Then you may integrate the cpp file and PHP+Twitter Bootstrap interface by adding those files in <code>EstimationNitrogenANN/pages/</code>
<ul>
<li><code>ann.cbp</code></li>
<li><code>ann.layout</code></li>
<li><code>ann.php</code></li>
</ul>
</p>
<p>Finally, you can run <code>ann.php</code> file on localhost to test. Make sure you have set up local testing server.</p>

<p>In <code>ann.php</code> file, you will look the <code>exec</code> PHP function to pass parameter that we set through interface to argument of function in C++ program, <code>main.cpp</code> in line 202:
</p>
<pre>
<code>
//Fungsi exec untuk pass parameter dari PHP ke argumen fungsi di program c++
exec("bin\\Debug\\ann $dl $var $epoch $error $lrate $momentum $ftr $fts $dt $attrib",$output);
</code>
</pre>

Yey! You can test this ANN model by uploading the training and testing file in <code>EstimationNitrogenANN/pages/</code> and do parameter trial-error to get the best model

