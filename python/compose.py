from PIL import Image

def merge_image(background, foreground, position=[0,0], output="output.png"):
    foreground = Image.open(foreground)
    background = Image.open(background)
    position = [0, 0, position[0], position[1]]
    background.paste(foreground, tuple(position), foreground)
    background.save(output)

def get_image_size_info(image):
    width, height = image.size

def resize():
    Image.new('RGB', (800,1280), (255, 255, 255))

if __name__ == '__main__':
    merge_image('body/01.png', 'head/01.png', [0,0], 'body_head.png')

# POSITIONS
# eye onto head: [280, 50]
# head onto body: [, ]