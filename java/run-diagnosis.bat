@echo off
setlocal enabledelayedexpansion

:: 1. Read the first line of input.txt into a variable.
set "CSV_DATA="
for /f "delims=" %%i in (input.txt) do (
    set "CSV_DATA=%%i"
    goto :continue
)

:continue
:: 2. Check if data was read successfully.
if not defined CSV_DATA (
    echo ERROR: Could not read data from input.txt or the file is empty.
    exit /b 1
)

:: 3. Pass the data from the variable as a command-line argument.
echo Classifying data from input.txt: "%CSV_DATA%"
java -cp .;weka.jar DiagnosisClassifier "!CSV_DATA!" > output.txt

echo Classification complete. Result written to output.txt.

endlocal