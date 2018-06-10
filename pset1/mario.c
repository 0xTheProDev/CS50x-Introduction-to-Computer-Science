#include <cs50.h>   //For Input purpose
#include <stdio.h>  //For 'printf' function

int main(void)
{
    int l,c;
    printf("Height: ");
    l = GetInt();
    while(l<0 || l>23)
    {
        printf("Height: ");
        l = GetInt();
        if(l==0) return 0;
    }
    c = l + 1;
    for(int i=0 ; i<l ; i++)
    {
        for(int j=0 ; j<c-i-2 ; j++)
        printf(" ");
        for(int j=0 ; j<i+2 ; j++)
        printf("#");
        
        printf("\n");
    }
}