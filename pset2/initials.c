
#include <cs50.h>
#include <ctype.h>
#include <stdio.h>
#include <string.h>

int main(void)
{
    string in;
    in = GetString();
    char ch = in[0];
    if(isupper(ch))
        printf("%c",ch);
    else
        printf("%c",(ch-32));
    for(int i=1; i<strlen(in);  i++)
    {
        if(in[i]==' ')
        {
            ch = in[i+1];
            if(isupper(ch))
                printf("%c",ch);
            else
                printf("%c",(ch-32));
        }
    }
    printf("\n");
    return 0;
}
