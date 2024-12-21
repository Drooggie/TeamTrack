echo "Enter name for application or leave it emply to be default"
read suggested_name

core_dir="template-docker-laravel"
compose_file="docker-compose.yml"
env_file="./src/.env.example"

if [ -z "$suggested_name" ]; then
    app_name="template"
    folder_name="$core_dir"
else
    app_name="${suggested_name,,}"
    folder_name="${suggested_name^}"
fi



if [ ! -d "../$core_dir" ]; then
    echo "Error: '$core_dir' directory does not exist."
fi

if [ ! -f "$compose_file" ]; then
    echo "Error: '$compose_file' does not exist."
    exit 1
fi

if [ ! -f "$env_file" ]; then
    echo "Error: '$env_file' does not exist."
    exit 1
fi




if [[ "$OSTYPE" == "darwin"* ]]; then
    sed -i '' "s/template/$app_name/g" "$compose_file"  
    sed -i '' "s/DB_DATABASE=.*/DB_DATABASE=$app_name/g" "$env_file"
else
    sed -i "s/template/$app_name/g" "$compose_file"  
    sed -i "s/DB_DATABASE=.*/DB_DATABASE=$app_name/g" "$env_file"
fi

cd ..
mv "$core_dir" "$folder_name"

echo "Application name has been successfully updated to $folder_name"