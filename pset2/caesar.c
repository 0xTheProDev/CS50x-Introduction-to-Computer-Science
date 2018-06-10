/*
Caesar Cypher
Progyan
*/

#include <cs50.h>
#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>
#include <string.h>

int main(int argc, string argv[])
{
    if (argc != 2)
    {
        printf("Usage: caesar <key>\n");
        return 1;
    }
    /*
    Getting key
    */
    int k = atoi(argv[1]);
    /*
    Getting plain text
    */
    string text;
    text = GetString();
    char ascii;
    /*
    Encyphering
    */
    for (int i=0, n=strlen(text); i < n; i++)
    {
        if (isalpha(text[i]))
        {
            ascii = (isupper(text[i])) ? 'A' : 'a';
            text[i] = (text[i] - ascii + k) % 26 + ascii;
        }
    }
    /*
    Returning Cyphertext
    */
    for (int i = 0, n = strlen(text); i < n; i++)
    {
        printf("%c", text[i]);
    }
    printf("\n");
    return 0;
}
