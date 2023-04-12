import cv2

# Load the cascade
face_cascade = cv2.CascadeClassifier(r'C:\xampp\htdocs\coffee_version6\python\venv\Lib\site-packages\cv2\data\haarcascade_frontalface_default.xml')

# To capture video from webcam.
cap = cv2.VideoCapture(1)
# To use a video file as input
# cap = cv2.VideoCapture('filename.mp4')

#add a valuable people to saveing the record
people=""

while True:
    #set a variable to show the number of people in the camera
    numberOfPeople = 0
    # Read the frame
    _, img = cap.read()
    # resizing for faster detection
    img = cv2.resize(img, (854, 480))
    # Convert to grayscale
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    # Detect the faces
    faces = face_cascade.detectMultiScale(gray, 1.2, 4)
    # Draw the rectangle around each face

    firstBreak = 284.6
    secondBreak = 569.2
    location = ""

    for (x, y, w, h) in faces:
        if (x < firstBreak) & (x+w > firstBreak):  # left middle
            location = "left-middle"
        elif (x < secondBreak) & (x+w> secondBreak):  # right middle
            location = "right-middle"
        elif (x < firstBreak) & (x+w < firstBreak):  # left
            location = "left"
        elif (x > secondBreak) & (x+w > secondBreak):  # right
            location = "right"
        elif (x > firstBreak) & (x+w < secondBreak):  # middle
            location = "middle"

        cv2.rectangle(img, (x, y), (x+w, y+h), (255, 0, 0), 2)
        cv2.putText(img, location, (x, y), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 0, 0))
        numberOfPeople +=1;
        #people="Yes"
    #show the number of people in the vedio
    cv2.putText(img, "number of people = " + str(numberOfPeople), (480, 25), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 0, 0))
    # Displayq
    cv2.imshow('img', img)

   # if people=="Yes":
     #  print("Yes")
      # people ="No"
   # else:
     #   print("No")

    if cv2.waitKey(1) & 0xFF == ord('q'):
        break
# Release the VideoCapture object
cap.release()