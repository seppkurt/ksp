#!/bin/bash
# SSH Upload Script for DomainFactory Webspace
# Usage: ./upload.sh ssh-user@yourdomain.tld /path/to/webspace

if [ -z "$1" ] || [ -z "$2" ]; then
    echo "Usage: $0 ssh-user@domain.tld /remote/path/to/webspace"
    echo "Example: $0 ssh-user@example.com /kunden/homepages/xx/xxxxx/web"
    exit 1
fi

SSH_HOST=$1
REMOTE_PATH=$2

echo "Uploading files to $SSH_HOST:$REMOTE_PATH"
echo ""

# Upload HTML files
scp index.html center-of-mass.html center-of-mass-de.html "$SSH_HOST:$REMOTE_PATH/"

echo ""
echo "Upload complete!"
echo "Files uploaded:"
echo "  - index.html"
echo "  - center-of-mass.html"
echo "  - center-of-mass-de.html"
