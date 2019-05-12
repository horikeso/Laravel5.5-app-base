FROM centos:centos7

ADD init.sh /init.sh

RUN chmod 700 /init.sh

RUN /init.sh

RUN rm -f /*.sh
