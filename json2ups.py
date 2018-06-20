#! /usr/bin/python
# -*- codinf: UTYF-8 -*-

import json
import types
import sys

def json_to_upstream(data):
    if not data:
        print 'error: empty data\n'
        exit(1)
    

    d_type = type(data)
    if d_type is not types.DictType:
        print 'error: data type not dict\n'
        exit(1)

    res = ''
    if 'balancer.upstreams' not in data or not data['balancer.upstreams']:
        print 'error: empty upstreams\n'
        exit(1)

    upstreams = data['balancer.upstreams']
    for name in upstreams:
        options = upstreams[name]
        if not options['enable']:
            continue

        if not options['servers'] or not len(options['servers']) or type(options['servers']) is not types.DictType:
            continue

        update = False
        for ip in options['servers']:
            if options['servers'][ip]['enable'] == True:
                update = True

        if not update:
            continue


        res += 'upstream ' + name + ' {\n'
        if options['type'] == 1:
            if options['hashvar'] == 0:
                res += '    hash $hash_uri consistent;\n'
            if options['hashvar'] == 1:
                res += '    hash $remote_addr consistent;\n'

        if 'keepalive' in options and options['keepalive'] != 0:
            res += '    keepalive ' + str(options['keepalive']) + '\n'

        res += '\n'

        for ip in options['servers']:
            serv = options['servers'][ip]
            if serv['enable'] != True:
                continue

            res += '    server ' + ip
            if serv['weight'] != 1:
                res += ' weight=' + str(serv['weight'])
            if serv['is_backup'] == True:
                res += ' backup'
            res += ';\n'
        res += '}\n\n\n'
    return res

src = open(sys.argv[1], 'r')
upstreams = json_to_upstream(json.loads(src.read()))
dst = open(sys.argv[2], 'w+')
dst.write(upstreams)

