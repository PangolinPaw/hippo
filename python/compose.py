from PIL import Image
import time
import random
import sqlite3

DB = ''
C = ''
DB_FILE = '../data/data.db'

OUTPUT_PATH = '../media/animal/'

def initalise():
    global DB, C
    if C == '':
        DB = sqlite3.connect(DB_FILE)
        C = DB.cursor()

def generate(genotype):
    # prepare background
    background = Image.open('background.png')
    output = Image.new('RGBA', background.size, (0, 0, 0, 0))
    output.paste(background, (0,0))
    # body
    foreground = Image.open('body/{:02d}.png'.format(min(genotype['colour'])))
    output.paste(foreground, (480,120), foreground.convert('RGBA'))
    #coat - not yet implemented
    # foreground = Image.open('coat/{:02d}.png'.format(min(genotype['coat'])))
    # output.paste(foreground, (480,120), foreground.convert('RGBA'))
    # tusk
    foreground = Image.open('tusk/{:02d}.png'.format(min(genotype['tusk'])))
    output.paste(foreground, (70,522), foreground.convert('RGBA'))
    # head
    foreground = Image.open('head/{:02d}.png'.format(min(genotype['colour'])))
    output.paste(foreground, (0,0), foreground.convert('RGBA'))
    # eye
    foreground = Image.open('eye/{:02d}.png'.format(min(genotype['eye'])))
    output.paste(foreground, (280,50), foreground.convert('RGBA'))
    # tail - not yet implemented
    #foreground = Image.open('tail/{:02d}.png'.format(min(genotype['tail'])))
    #output.paste(foreground, (?,?), foreground.convert('RGBA'))

    # save output
    output_name = '{}{:02d}{:02d}{:02d}{:02d}{:02d}{:02d}.png'.format(OUTPUT_PATH, min(genotype['colour']),  min(genotype['colour']), min(genotype['eye']), min(genotype['tusk']), min(genotype['tail']), min(genotype['coat']))
    output.save(output_name, format='png')
    return output_name

def create_wild(starter=False):
    # Probabilities:
      #     colour  eye     tusk    coat    tail    happy   intel
      # 0   ---     ---     50%     ---     ---     ---     ---
      # 1   31%     24%     50%     ---     ---     ---     ---
      # 2   33%     24%     ---     ---     ---     ---     ---
      # 3   22%     20%     ---     ---     ---     ---     ---
      # 4   12%     12%     ---     ---     ---     ---     ---
      # 5    2%     12%     ---     ---     ---     ---     ---
      # 6   ---      6%     ---     ---     ---     ---     ---
    colour_list = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 4, 5]
    eye_list = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 4, 5, 5, 5, 5, 5, 5, 6, 6, 6]
    tusk_list = [0, 1]
    tail_list = [0, 0]
    coat_list = [0, 0]
    happy_list = [0, 0]
    intel_list = [0, 0]

    if starter:
        colour_list = [1, 1]
        eye_list = [1, 1]
        tusk_list = [0, 0]

    colour_1 = random.choice(colour_list)
    colour_2 = random.choice(colour_list)
    genotype = {
                'colour':[colour_1,colour_2],
                'eye' :[random.choice(eye_list),random.choice(eye_list)],
                'tusk':[random.choice(tusk_list),random.choice(tusk_list)],
                'tail':[random.choice(tail_list),random.choice(tail_list)],
                'coat':[random.choice(coat_list),random.choice(coat_list)],
                'happy':[random.choice(happy_list),random.choice(happy_list)],
                'intelligence':[random.choice(intel_list),random.choice(intel_list)]
                }

    return genotype

def store_genotype(genotype):
    print 'head\tbody\teye\t\ttusk\ttail\tcoat\thappy\tint.'
    print '{}\t{}\t{}\t{}\t{}\t{}\t{}\t{}'.format(genotype['colour'], genotype['colour'], genotype['eye'], genotype['tusk'], genotype['tail'], genotype['coat'], genotype['happy'], genotype['intelligence'])

    for key in genotype:
        genotype[key] = sorted(genotype[key])

    genes = [genotype['colour'][0], genotype['colour'][1], genotype['colour'][0], genotype['colour'][1], genotype['eye'][0], genotype['eye'][1], genotype['tusk'][0], genotype['tusk'][1], genotype['tail'][0], genotype['tail'][1], genotype['coat'][0], genotype['coat'][1], genotype['happy'][0], genotype['happy'][1], genotype['intelligence'][0], genotype['intelligence'][1]]
    unique_code = ''.join(str(x) for x in genes)

    initalise()
    try:
        C.execute('INSERT INTO genetics (HEAD_1, HEAD_2, BODY_1, BODY_2, EYE_1, EYE_2, TUSK_1, TUSK_2, TAIL_1, TAIL_2, COAT_1, COAT_2, HAPPY_1, HAPPY_2, INTELLIGENT_1, INTELLIGENT_2, UNIQUE_CODE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', (genotype['colour'][0], genotype['colour'][1], genotype['colour'][0], genotype['colour'][1], genotype['eye'][0], genotype['eye'][1], genotype['tusk'][0], genotype['tusk'][1], genotype['tail'][0], genotype['tail'][1], genotype['coat'][0], genotype['coat'][1], genotype['happy'][0], genotype['happy'][1], genotype['intelligence'][0], genotype['intelligence'][1], unique_code))
    except:
        print '(Genotype previously encountered)'

    DB.commit()


def breed(mother, father):
    # Hereditability determined by size of number. 
    # Lower number = more dominant
    # e.g. 3 dominates all higher numbers, but is recessive to 2 and 1
    child = {}
    for gene in sorted(mother):
        from_mother = random.choice(mother[gene])
        from_father = random.choice(father[gene])
        child[gene] = [from_mother, from_father]
        
    return child

def populate(number):
    x = 0
    while x < number:
        hippo = create_wild()
        image_filename = generate(hippo)
        store_genotype(hippo)
        x = x + 1


def demo(limit):
    mother = create_wild()
    mother_name = generate(mother)
    store_genotype(mother)
    father = create_wild()
    father_name = generate(father)

    print '{} x {}: '.format(mother_name, father_name)
    x = 0
    while x < limit:
        child = breed(mother, father)
        child_name = generate(child)
        print ' > {}'.format(child_name)
        x = x + 1


if __name__ == '__main__':
    # demo(5)
    populate(1)

