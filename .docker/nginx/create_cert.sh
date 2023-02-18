if [ -z "$1" ]
then
  echo "Enter domain";
  exit;
fi

DOMAIN=$1
COMMON_NAME=${2:-$1}

SUBJECT="/C=RU/ST=Moscow/L=Moscow/O=$COMMON_NAME/CN=$COMMON_NAME"
NUM_OF_DAYS=999

sudo mkdir ./cert/tmp

sudo openssl genrsa -out ./cert/tmp/rootCA.key

sudo openssl req -x509 -new -nodes -key ./cert/tmp/rootCA.key -sha256 -days $NUM_OF_DAYS -subj "$SUBJECT" -out ./cert/tmp/rootCA.pem

sudo openssl req -new -newkey rsa:2048 -sha256 -nodes -keyout ./cert/device.key -subj "$SUBJECT" -out ./cert/tmp/device.csr

sudo cat cert.ext | sed s/%%DOMAIN%%/$COMMON_NAME/g > ./cert/tmp/__cert.ext

sudo openssl x509 -req -in ./cert/tmp/device.csr -CA ./cert/tmp/rootCA.pem -CAkey ./cert/tmp/rootCA.key -CAcreateserial -out ./cert/device.crt -days $NUM_OF_DAYS -sha256 -extfile ./cert/tmp/__cert.ext

sudo rm -r ./cert/tmp
mv ./cert/device.crt ./cert/$COMMON_NAME.crt
mv ./cert/device.key ./cert/$COMMON_NAME.key
