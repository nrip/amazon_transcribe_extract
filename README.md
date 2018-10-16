# amazon_transcribe_extract
Script to extract a readable transcript from an Amazon Transcribe .json transcript 

1. Open the file "transcribe.php". On line no. 5, there is a variable called $ip_file which is set to "test.json". Set this to whatever name you have given to the input file. 
On line no. 6, there is a variable called $op_file. Set this to whatever name you want the generated output file to be called.

2. Place the file transcribe.php and the input file in the same folder.  For e.g. I named this folder amazon_transcribe, and I have placed the file "transcribe.php" and the input file "test.json" inside amazon_transcribe

2a. Open the terminal, and go to the folder amazon_transcribe (or whatever you named your folder)

3. Run the command "php -v " at the terminal to confirm you have php running. This company will give you the version number of the installed php executable. Macbooks come with PHP typically pre installed, so this should simply work and you should see something like whats attached in the screenshot below.

4. Now, run the command "php transcribe.php" to execute the script. It should take less than a second to run and should generate the output file that you specified in the same folder.
