##########################################
# 	WEBSERVER ARDUINO		#
# 	v.2.0				#
# 	2/07/2014			#
# 	leonardo.bravo@mail.udp.cl	#
##########################################

import os
import time



#!flask/bin/python
from flask import Flask
from flask import json
from flask import jsonify
from flask import request
from flask import Response
from datetime import date

#ARDUINO
#import serial
#import time
import l
import h
  

#DECORADOR HTML LIB
from datetime import timedelta
from flask import make_response, request, current_app
from functools import update_wrapper

#DECORADOR HTML
def crossdomain(origin=None, methods=None, headers=None,max_age=21600, attach_to_all=True,automatic_options=True):
    if methods is not None:
        methods = ', '.join(sorted(x.upper() for x in methods))
    if headers is not None and not isinstance(headers, basestring):
        headers = ', '.join(x.upper() for x in headers)
    if not isinstance(origin, basestring):
        origin = ', '.join(origin)
    if isinstance(max_age, timedelta):
        max_age = max_age.total_seconds()

    def get_methods():
        if methods is not None:
            return methods

        options_resp = current_app.make_default_options_response()
        return options_resp.headers['allow']

    def decorator(f):
        def wrapped_function(*args, **kwargs):
            if automatic_options and request.method == 'OPTIONS':
                resp = current_app.make_default_options_response()
            else:
                resp = make_response(f(*args, **kwargs))
            if not attach_to_all and request.method != 'OPTIONS':
                return resp

            h = resp.headers

            h['Access-Control-Allow-Origin'] = origin
            h['Access-Control-Allow-Methods'] = get_methods()
            h['Access-Control-Max-Age'] = str(max_age)
            if headers is not None:
                h['Access-Control-Allow-Headers'] = headers
            return resp

        f.provide_automatic_options = False
        return update_wrapper(wrapped_function, f)
    return decorator


app = Flask(__name__)



@app.route('/')
@app.route('/index')
def index():
  return "<br>PANORAMIX WEBSERVER<br>======================<br><br>Hello, World!\n"	

@app.route('/')
@app.route('/on')
def on():
  h.turn_on()
  return "Luces ON"

@app.route('/')
@app.route('/off')
def off():
  l.turn_off()
  return "Luces OFF"

if __name__ == '__main__':
  port = int(os.environ.get('PORT', 5000))
  app.debug = True
  app.run(host='0.0.0.0', port=port)

