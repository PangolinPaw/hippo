from PIL import Image
import time
import random

OUTPUT_PATH = '../media/animal/'

def generate(body=1, tusk=1, head=1, eye=1):
    # prepare background
    background = Image.open('background.png')
    output = Image.new('RGBA', background.size, (0, 0, 0, 0))
    output.paste(background, (0,0))
    # body
    foreground = Image.open('body/{:02d}.png'.format(body))
    output.paste(foreground, (480,120), foreground.convert('RGBA'))
    # tusk
    foreground = Image.open('tusk/{:02d}.png'.format(tusk))
    output.paste(foreground, (70,522), foreground.convert('RGBA'))
    # head
    foreground = Image.open('head/{:02d}.png'.format(head))
    output.paste(foreground, (0,0), foreground.convert('RGBA'))
    # eye
    foreground = Image.open('eye/{:02d}.png'.format(eye))
    output.paste(foreground, (280,50), foreground.convert('RGBA'))
    # save output
    output_name = '{}{:02d}{:02d}{:02d}{:02d}.png'.format(OUTPUT_PATH, body, tusk, head, eye)
    output.save(output_name, format='png')
    return output_name

def demo():
     x = 0
    while x < 5:
        colour = random.randint(1,5)
        eye = random.randint(1,6)
        tusk = random.randint(0,1)
        # build_animal(colour, 1,  colour, eye)
        generate(colour, tusk,  colour, eye)
        time.sleep(1)
        x = x + 1

if __name__ == '__main__':
   demo()