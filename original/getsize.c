#include <stdio.h>
unsigned long get_file_size(const char *filename){
    unsigned long size;
    FILE *fp = fopen( filename, "r" );
    if(fp==NULL){
        printf("ERROR: Open file %s failed.\n", filename);
        return 0;
    }
    fseek( fp, 0L, SEEK_END );
    size=ftell(fp);
    fclose(fp);
    return size;
}
int main()
{
  char filename[12];
  long size;
  while(1)
    {
      filename[0]='.';
      filename[1]='/';
      if((filename[2]=getchar()) == 'z')
        {
          break;
        }
      filename[3]=getchar();
      filename[4]=getchar();
      filename[5]=getchar();
      filename[6]=getchar();
      filename[7]=getchar();
      filename[8]='.';
      filename[9]='t';
      filename[10]='x';
      filename[11]='t';
      size=get_file_size(filename);
      filename[10]=getchar();
      printf("%ld\n",size);
    }
  return 0;
}


