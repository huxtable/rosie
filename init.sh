# A self-destructing script to quickly set up the new repository
read -p "Project name: " projectName

## Remove Rudy repository details
git remote rm origin
git checkout --orphan master &> /dev/null

## Move entrypoint
mv ./bin/rosie ./bin/$projectName
mv ./lib/rosie ./lib/$projectName

## README
if [ -f README.md ]; then
	rm README.md
fi

echo "# ${projectName}" >> README.md

## Delete this file
rm init.sh

## Unstage all files
git rm -r --cached . &> /dev/null

echo "Done."
