FROM mattrayner/lamp:latest-1604

# Copy our code in
COPY src/ /app/

# Copy the config files in
# COPY conf/apache2.conf /etc/apache2/apache2.conf

# Run the server
# CMD apachectl -D FOREGROUND
CMD ["/run.sh"]
