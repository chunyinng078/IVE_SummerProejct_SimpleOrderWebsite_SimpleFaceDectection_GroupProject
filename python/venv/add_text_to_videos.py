# import the opencv library
import cv2

# define a video capture object
cap=cv2.VideoCapture(1,cv2.CAP_DSHOW)
print(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
print(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))

cap.set(3, 1208)
cap.set(4, 720)

print(cap.get(3))
print(cap.get(4))

while(cap.isOpened()):

    # Capture the video frame
    # by frame
    ret, frame = cap.read()
    if ret == True:

        #set a gray to set the image for grey color
        gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        # Display the resulting frame
        cv2.imshow('frame', gray)

        # the 'q' button is set as the
        # quitting button you may use any
        # desired button of your choice
        if cv2.waitKey(1) & 0xFF == ord('q'):
            break
    else:
        break

# After the loop release the cap object
cap.release()
# Destroy all the windows
cv2.destroyAllWindows()