
/*
Vigenere Cypher
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
        printf("Usage: vigenere <key>\n");
        return 1;
    }
    /*
    Getting key
    */
    char ascii;
    string keys = argv[1];
    int klen = strlen(keys);
    int key[klen];
    for (int j=0; j < klen; j++)
    {
        if (isalpha(keys[j]))
        {
            ascii = (isupper(keys[j])) ? 'A' : 'a';
            key[j] = keys[j] - ascii;
        }
        else
        {
            printf("Use alphabetic as keyword\n");
            return 1;
        }
    }
    /*
    Getting plain text
    */
    string text;
    text = GetString();
    /*
    Encyphering
    */
    for (int i=0, j=0, n=strlen(text); i < n; i++)
    {
        if (j == klen)
        {
            j = 0;
        }
        if (isalpha(text[i]))
        {
            ascii = (isupper(text[i])) ? 'A' : 'a';
            text[i] = (text[i] - ascii + key[j]) % 26 + ascii;
            j++;
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