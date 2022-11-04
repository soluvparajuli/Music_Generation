let count1=0;
let count2=0;
function openCvReady() {
    cv['onRuntimeInitialized'] = () => {
      let video = document.getElementById('cam_input');
      // using WebRTC to get media stream
      navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then(function (stream) {
          video.srcObject = stream;
          video.play();
        })
        .catch(function (err) {
          console.log('An error has occured! ' + err);
        });

      let src = new cv.Mat(video.height, video.width, cv.CV_8UC4);
      let gray = new cv.Mat();
      let cap = new cv.VideoCapture(cam_input);
      // let bodys = new cv.RectVector();
      let faces = new cv.RectVector();
      // let eyes = new cv.RectVector();
      // let upperbodyClassifier=new cv.CascadeClassifier();
      let faceClassifier = new cv.CascadeClassifier();
      // let eyeClassifier = new cv.CascadeClassifier();
      let utils = new Utils('errorMessage');
      // let upperbodyCascade='HS.xml';
      let faceCascade = 'haarcascade_frontalface_default.xml';
      // let eyeCascade = 'haarcascade_eye.xml';
      // utils.createFileFromUrl(upperbodyCascade, upperbodyCascade, () => {
      //   upperbodyClassifier.load(upperbodyCascade);
      // });
      utils.createFileFromUrl(faceCascade, faceCascade, () => {
        faceClassifier.load(faceCascade);
      });
      // utils.createFileFromUrl(eyeCascade, eyeCascade, () => {
      //   eyeClassifier.load(eyeCascade);
      // });
      let wid=480;
      let hei=360;
      const FPS = 30;
      function processVideo() {
        let begin = Date.now();
        cap.read(src);
        cv.cvtColor(src, gray, cv.COLOR_RGBA2GRAY, 0);
        try {

          faceClassifier.detectMultiScale(gray, faces, 1.1, 3, 0);
          if (faces.size()==0){
              // console.log("No faces Detected");
              //start countdown
              count1=(1.1)*count1;
          }
          else{
            if(count1>1){
              count1=0.95*count2;
            }
            else if(count==0){
              count1=0;
            }
            else{
              count1=1;
            }
            let largestface=faces.get(0);
            if(faces.size()>1){
              for (let i = 1; i < faces.size(); ++i){
                let temparea=largestface.width*largestface.height;
                let face = faces.get(i);
                if(temparea<=face.width*face.height){
                  largestface=face;
                }
              }
            }
            
              let point1 = new cv.Point(largestface.x, largestface.y);
              let point2 = new cv.Point(largestface.x + largestface.width, largestface.y + largestface.height);
              cv.rectangle(src, point1, point2, [0, 255, 0, 255],3);
              let ra={xmin: video.width/3, ymin: video.height/3, xmax: 2*video.width/3, ymax: 2*video.height/3};
              let rb={xmin: largestface.x, ymin: largestface.y, xmax: largestface.x + largestface.width, ymax: largestface.y + largestface.height};
              let left=ra.xmin>=rb.xmin?ra.xmin:rb.xmin;
              let right=ra.xmax>=rb.xmax?rb.xmax:ra.xmax;
              let top=ra.ymin>=rb.ymin?ra.ymin:rb.ymin;
              let bottom=ra.ymax>=rb.ymax?rb.ymax:ra.ymax;
              let dx=Math.abs(left-right);
              let dy=Math.abs(top-bottom);
              let co=[255, 255, 255, 255];
              if(dx*dy< 0.4*(ra.xmax-ra.xmin)*(ra.ymax-ra.ymin)){
                // console.log("Face out of bounds");
                 co=[255, 0, 0, 255];
                //start counting
                count2=1.2*count2;
              }
              else{
                
                if(count2>1){
                  count2=0.95*count2;
                }
                else if(count==0){
                  count2=0;
                }
                else{
                  count2=1;
                }
              }
              let point3 = new cv.Point(left,top);
              let point4 = new cv.Point(right,bottom);
              cv.rectangle(src, point3, point4, co,4);
              
              // eyeClassifier.detectMultiScale(gray, eyes, 1.1, 3, 0);
              // for (let j = 0; j < eyes.size(); j++) {
              //   let eye = eyes.get(j);
              //   let point1 = new cv.Point(eye.x, eye.y);
              //   let point2 = new cv.Point(eye.x + eye.width, eye.y + eye.height);
              //   cv.rectangle(src, point1, point2, [0, 0, 255, 255],3);
              // }
            //   }
          }
       
        } catch (err) {
          console.log(err);
        }

        let srcscaled = new cv.Mat();
        cv.resize(src, srcscaled, new cv.Size(wid, hei), 0, 0, cv.INTER_AREA);
        // drawing the safe zone
        let point1 = new cv.Point(wid/3,hei/3);
        let point2 = new cv.Point(2*wid/3,2*hei/3);
        cv.rectangle(srcscaled, point1, point2, [ 0, 0, 255, 255],3);
        cv.imshow('canvas_output', srcscaled);

        //disqualifying
        if(count1>20 || count2 > 15){
          alert("You are disqualified.");
          location.href="student_panel.php";
          count1=1;
          count2=1;
        }

        let delay = 1000 / FPS - (Date.now() - begin);
        // schedule next one
        setTimeout(processVideo, delay);
      }

      // schedule first one 
      setTimeout(processVideo, 0);
    }
  }