function openCvReady() {

    cv['onRuntimeInitialized'] = () => {
      let video = document.getElementById('cam_input');
      // using WebRTC to get media stream
      var constraints = {
        audio: false,
        video: true
    };

      navigator.mediaDevices.getUserMedia(constraints)
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
      let bodys = new cv.RectVector();
      let faces = new cv.RectVector();
      let eyes = new cv.RectVector();
      let upperbodyClassifier=new cv.CascadeClassifier();
      let faceClassifier = new cv.CascadeClassifier();
      let eyeClassifier = new cv.CascadeClassifier();
      let utils = new Utils('errorMessage');
      // let upperbodyCascade='HS.xml';
      let faceCascade = 'haarcascade_frontalface_default.xml';
      let eyeCascade = 'haarcascade_eye_tree_eyeglasses.xml';
      // utils.createFileFromUrl(upperbodyCascade, upperbodyCascade, () => {
      //   upperbodyClassifier.load(upperbodyCascade);
      // });
      utils.createFileFromUrl(faceCascade, faceCascade, () => {
        faceClassifier.load(faceCascade);
      });
      utils.createFileFromUrl(eyeCascade, eyeCascade, () => {
        eyeClassifier.load(eyeCascade);
      });

      const FPS = 30;
      function processVideo() {
        let begin = Date.now();
        cap.read(src);
        cv.cvtColor(src, gray, cv.COLOR_RGBA2GRAY, 0);
        try {

          // upperbodyClassifier.detectMultiScale(gray, bodys, 1.1, 3, 0);
          // for (let i = 0; i < bodys.size(); ++i) {
          //   let body = bodys.get(i);
          //   let point1 = new cv.Point(body.x, body.y);
          //   let point2 = new cv.Point(body.x + body.width, body.y + body.height);
          //   cv.rectangle(src, point1, point2, [255, 0, 0, 255],2);

          faceClassifier.detectMultiScale(gray, faces, 1.1, 3, 0);
          for (let i = 0; i < faces.size(); ++i) {
            let face = faces.get(i);
            let point1 = new cv.Point(face.x, face.y);
            let point2 = new cv.Point(face.x + face.width, face.y + face.height);
            cv.rectangle(src, point1, point2, [0, 255, 0, 255],3);

            eyeClassifier.detectMultiScale(gray, eyes, 1.1, 3, 0);
            for (let j = 0; j < eyes.size(); j++) {
              let eye = eyes.get(j);
              let point1 = new cv.Point(eye.x, eye.y);
              let point2 = new cv.Point(eye.x + eye.width, eye.y + eye.height);
              cv.rectangle(src, point1, point2, [0, 0, 255, 255],3);
            }
          //   }
          }
        } catch (err) {
          console.log(err);
        }
        let srcscaled = new cv.Mat();
        cv.resize(src, srcscaled, new cv.Size(480, 360), 0, 0, cv.INTER_AREA);
        cv.imshow('canvas_output', srcscaled);

        let delay = 1000 / FPS - (Date.now() - begin);
        // schedule next one
        setTimeout(processVideo, delay);
      }

      // schedule first one 
      setTimeout(processVideo, 0);
    }
  }