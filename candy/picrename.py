#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Mon May 23 19:42:02 2022

@author: alex
"""

import sys
from PIL import Image, ImageDraw, ImageFont
import glob
piclist=glob.glob('*.png')
print(piclist)
# get an image
for i in piclist:
    with Image.open(i).convert("RGBA") as base:
        date= i.replace('.png', '')
        # make a blank image for the text, initialized to transparent text color
        txt = Image.new("RGBA", base.size, (255, 255, 255, 0))

        bs= base.size
        print (bs[0])
        # get a font
        fnt = ImageFont.truetype("Quicksand-Regular.ttf", 30)
        # get a drawing context
        d = ImageDraw.Draw(txt)

        # draw text, half opacity
        d.text((bs[0]-150, bs[1] -40), date, font=fnt, fill=(255, 255, 255, 255))
        # draw text, full opacity

        out = Image.alpha_composite(base, txt)

        out.show()
        out.save(i)
